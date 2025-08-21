@extends('admin.layouts.app')

@section('content')
<style>
    .box {
  width: 25px;
  height: 45px;
  margin: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  font-weight: bold;
  border: 2px dashed #ccc;  
  border-radius: 6px;      
    }  

.space {
  border: none;  
  width: 20px;   
}

.clue-img {
    margin: 10px;
    width: 100%;         
    height: 200px;       
    object-fit: cover;   
  border-radius: 8px;  
}

#keyboard{
    margin-right: 20px;
}

/* .clue-shutter {
    width: 100%;
    height: 180px;
    background: linear-gradient(135deg, #444, #111);
    color: #fff;
    font-weight: bold;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #666;
    border-radius: 8px;
    box-shadow: inset 0 0 20px rgba(0,0,0,0.8);
} */


</style>

<div class="container-fluid">

    <!-- START SCREEN -->
    <div id="start-screen" class="row align-items-center" style="margin: 150px 250px;">
    <!-- Left side: Start / Play -->
    <div class="col-md-6 text-center">
        <h2>🎮 How to Play – UltraTech Word Quest</h2>
        <p class="mt-3">
            Get ready to guess <b>3 mystery words</b> within <b>5 minutes</b>.<br>
            Wrong letters deduct points, so choose carefully!
        </p>
        <button id="start-btn" class="btn btn-success btn-lg mt-4">Start Game</button>
    </div>

    <!-- Right side: Rules -->
    <div class="col-md-6 ">
        <h4>Rules:</h4>
        <ol style="line-height: 1.6;">
            <li>You will play for 5 minutes to guess 3 mystery words.</li>
            <li>Each word comes with 4 image clues on the right side of the screen.</li>
            <li>Use the virtual keyboard to guess letters in the hidden word.
                <ul>
                    <li>Correct letter → Points added.</li>
                    <li>Wrong letter → Points deducted.</li>
                </ul>
            </li>
            <li>Feeling confident? Use the <b>Bonus Card</b> to guess the full word:
                <ul>
                    <li>Correct = Big Bonus Points.</li>
                    <li>Wrong = Penalty.</li>
                </ul>
            </li>
            <li>Complete all 3 words before the timer runs out to maximize your score.</li>
        </ol>
    </div>
</div>


    <!-- GAME SCREEN -->
    <div id="game-screen" class="row h-100 d-none " style=" margin: 50px 200px;">
        <!-- Left side -->
        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center py-4"  id="hud" >
            <div class="d-flex gap-3 align-items-center mb-2">
                <h5 id="word-progress" class="mb-0 text-secondary">Word 1 / 3</h5>
            </div>
            <h4 id="timer" class="mb-1 text-danger fw-bold">Time Left: 03:00</h4>
            <h5 id="score" class="mb-4 text-primary">Score: 100</h5>
             <button id="bonus-btn" class="btn btn-primary">🎴 Bonus Card</button>
            <!-- Word blocks -->
            <div id="word-container" class="mb-4 d-flex flex-wrap justify-content-center" style="padding: 7px;"></div>

            <!-- Virtual keyboard -->
            <div id="keyboard" class="d-flex flex-wrap justify-content-center" style="max-width: 420px;"></div>
             {{-- <button id="end-btn" class="text-black px-4 py-2 rounded m-5 bg-danger">
            End Game
        </button> --}}
        </div>

        <!-- Right side -->
        <div class="col-md-6 d-flex align-items-center justify-content-center py-4">
            <div id="image-container" class="row w-100" style="max-width: 640px;"></div>
            {{-- <button id="clue-btn" class="btn btn-warning mt-3">Show Next Clue (-10 points)</button> --}}
        </div>
    </div>

    <!-- END SCREEN -->
    <div id="end-screen" class="text-center p-5 d-none">
        <h2 id="end-message" class="mb-3"></h2>
        <h3 id="final-score" class="mt-2"></h3>
        <button id="restart-btn" class="btn btn-primary btn-lg mt-4">Play Again</button>
    </div>

</div>
@endsection


@push('scripts')
<!-- Load SweetAlert2 BEFORE the game script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // === Data: words + images (use your real image files under /public/images/...) ===
    const words = [
        {
            text: "COLLABORATION",
            images: [
                "{{ asset('images/Collab1.png') }}",
                "{{ asset('images/Collab2.png') }}",
                "{{ asset('images/Collab3.png') }}",
                "{{ asset('images/Collab4.png') }}"
            ]
        },
        {
            text: "WINNING TOGETHER",
            images: [
                "{{ asset('images/win1.png') }}",
                "{{ asset('images/win2.png') }}",
                "{{ asset('images/win3.png') }}",
                "{{ asset('images/win4.png') }}"
            ]
        },
        {
            text: "ONENESS",
            images: [
                "{{ asset('images/well1.png') }}",
                "{{ asset('images/well2.png') }}",
                "{{ asset('images/well3.png') }}",
                "{{ asset('images/well4.png') }}"
            ]
        }
    ];

//     const endBtn = document.getElementById("end-btn");
// endBtn.addEventListener("click", () => {
//     clearInterval(timerInterval);          // stop timer
//     showScreen(endScreen);                 // show end screen
//     endMessage.textContent = "🛑 Game Ended!"; // optional custom message
//     finalScore.textContent = `Your Score: ${score}`; // show current score
// });


    // === Game state ===
    let currentWordIndex = 0;
    let score = 100;
    let timeLeft = 300;
    let timerInterval = null;
    let questionStartTime = null;
    let questionData = [];
    // let currentClueIndex = 0;
    const usedLetters = new Set(); 

    // === Elements ===
    const startScreen   = document.getElementById("start-screen");
    const gameScreen    = document.getElementById("game-screen");
    const endScreen     = document.getElementById("end-screen");
    const wordContainer = document.getElementById("word-container");
    const keyboard      = document.getElementById("keyboard");
    const imageContainer= document.getElementById("image-container");
    const timer         = document.getElementById("timer");
    const scoreDisplay  = document.getElementById("score");
    const endMessage    = document.getElementById("end-message");
    const finalScore    = document.getElementById("final-score");
    const wordProgress  = document.getElementById("word-progress");


    function startQuestionTimer() {
    questionStartTime = Date.now();
}

function stopQuestionTimer() {
    const duration = Math.floor((Date.now() - questionStartTime) / 1000); // in seconds
    return duration + "s";
}
function logWordAttempt(correct, usedBonus = false, timeUp = false) {
    const timeTaken = stopQuestionTimer();
    const wordIndex = currentWordIndex + 1; // 1-based
    const answerStatus = timeUp ? "time_up" : (correct ? "correct" : "wrong");

    const payload = {
        word_number: wordIndex,
        score: score,
        time_taken: timeTaken,
        bonus_used: usedBonus ? 1 : 0,
        answer_status: answerStatus
    };

  fetch("/api/game/log", {
    method: "POST",
    headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
               
    },
    body: JSON.stringify(payload)
})
.then(res => res.json())
.then(data => {
    if (data.status !== 'success') {
        console.error("Error logging:", data);
    }
})
.catch(err => console.error("Fetch error:", err));

}



    // === Helpers ===
    function showScreen(screen) {
        startScreen.classList.add("d-none");
        gameScreen.classList.add("d-none");
        endScreen.classList.add("d-none");
        screen.classList.remove("d-none");
    }

    function formatTime(sec) {
        const m = String(Math.floor(sec / 60)).padStart(2, "0");
        const s = String(sec % 60).padStart(2, "0");
        return `${m}:${s}`;
    }

    function updateHUD() {
        wordProgress.textContent = `Word ${currentWordIndex + 1} / ${words.length}`;
        scoreDisplay.textContent = `Score: ${score}`;
        timer.textContent = `Time Left: ${formatTime(timeLeft)}`;
    }

    
    function renderWord() {
        wordContainer.innerHTML = "";
        // currentClueIndex = 0; 
        const word = words[currentWordIndex].text.toUpperCase();

        for (let i = 0; i < word.length; i++) {
            const ch = word[i];
            const span = document.createElement("div");
            span.className = (ch === " ") ? "box space" : "box";
            span.dataset.letter = ch;
            span.textContent = (ch === " ") ? "" : ""; 
            wordContainer.appendChild(span);
        }

        renderImages();
        renderKeyboard();
        updateHUD();
    }

    
    function renderImages() {
        imageContainer.innerHTML = "";
        const imgs = words[currentWordIndex].images;
        imgs.forEach(src => {      //imgs.forEach((src, i) => {
            const col = document.createElement("div");
            col.className = "col-6 position-relative";  //col-6 d-flex align-items-center justify-content-center
            //  if (i < currentClueIndex) {
            const img = document.createElement("img");
            img.src = src;
             img.className = "clue-img"; 
            img.alt = "Clue";
            col.appendChild(img);
        //  } else {
        //  const shutter = document.createElement("div");
        //     shutter.className = "clue-shutter";
        //     shutter.innerText = "🔒 Hidden Clue";
        //     col.appendChild(shutter);
        // }
            imageContainer.appendChild(col);
        });
    }

//     document.getElementById("clue-btn").addEventListener("click", () => {
//     const imgs = words[currentWordIndex].images;

//     if (currentClueIndex < imgs.length) {
//         currentClueIndex++;
//         score = Math.max(0, score - 10); // deduct -10
//         updateHUD();
//         renderImages();
//     } else {
//         Swal.fire({
//             icon: "info",
//             title: "No more clues!",
//             text: "All clues are already visible.",
//             timer: 1200,
//             showConfirmButton: false
//         });
//     }
// });

    
    function renderKeyboard() {
        keyboard.innerHTML = "";
        usedLetters.clear();
        const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        for (const l of letters) {
            const btn = document.createElement("button");
            btn.className = "btn btn-primary m-1";
            btn.type = "button";
            btn.textContent = l;
            btn.dataset.letter = l;
            btn.addEventListener("click", () => handleGuess(l, btn));
            keyboard.appendChild(btn);
        }
    }

    
    function handleGuess(letter, btnEl) {
        // normalize
        const L = letter.toUpperCase();
        // prevent multiple penalties if user types same physical key
        if (usedLetters.has(L)) return;
        usedLetters.add(L);

        // // disable associated on-screen button
        // if (!btnEl) {
        //     const btn = keyboard.querySelector(`button[data-letter="${L}"]`);
        //     if (btn) btn.disabled = true;
        // } else {
        //     btnEl.disabled = true;
        // }

        const spans = wordContainer.querySelectorAll(".box");
        const word  = words[currentWordIndex].text.toUpperCase();

        if (word.includes(L)) {
            // fill all occurrences
            spans.forEach(span => {
                if (span.dataset.letter === L) {
                    span.textContent = L;
                }
            });
             btnEl.style.backgroundColor = "yellow";
             
             btnEl.style.color = "black";
        score += 10;
        btnEl.disabled = true;
        updateHUD();

           

            // check completion (all letters filled or spaces)
            const completed = Array.from(spans).every(span =>
                span.classList.contains("space") || span.textContent === span.dataset.letter   
            );

            if (completed) {
                score += 50; 
                updateHUD();
                 logWordAttempt(true, false);
                // move to next word or win
                currentWordIndex++;
                if (currentWordIndex < words.length) {
                    updateHUD();
                    Swal.fire({
                        icon: "success",
                        title: "✅ Correct!",
                        text: "Moving to the next word...",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        renderWord();
                        renderKeyboard();
                    });
                } else {
                    endGame(true);
                }
            }
        } else {
            // wrong guess
            btnEl.style.backgroundColor = "red";
        btnEl.disabled = true;
        score = Math.max(0, score - 5);
        updateHUD();
            Swal.fire({
                icon: "error",
                title: "❌ Wrong letter",
                text: "-5 points",
                timer: 900,
                showConfirmButton: false
            });
        }
    }

    // === Timer ===
    function startTimer() {
        clearInterval(timerInterval);
        timerInterval = setInterval(() => {
            timeLeft--;
            timer.textContent = `Time Left: ${formatTime(timeLeft)}`;
            if (timeLeft <= 0) {
                logWordAttempt(false, false, true);
                clearInterval(timerInterval);
                endGame(false);
            }
        }, 1000);
    }

    // === End game ===
  function endGame(won) { 
    clearInterval(timerInterval);
    showScreen(endScreen);
    endMessage.textContent = won ? "🎉 Congratulations, You Won!" : "⏰ Time's Up!";
    finalScore.textContent = `Your Final Score: ${score}`;

  }

    // === Restart / Start ===
    function restartGame() {
        currentWordIndex = 0;
        score = 100;
        timeLeft = 300;
        updateHUD();
        showScreen(gameScreen);
        renderWord();
        renderKeyboard();
        startTimer();
    }

  
let bonusMode = false;
let bonusInput = ""; // store typed letters

function activateBonusCard() {
    if (bonusMode) return; // prevent multiple activations
    bonusMode = true;

    // Clear word block
    wordContainer.innerHTML = "";

    // Show a placeholder for typing
    const bonusBox = document.createElement("div");
    bonusBox.id = "bonus-box";
    bonusBox.textContent = "Type your guess and press Enter...";
    bonusBox.className = "bonus-active text-warning fw-bold mt-3";
    wordContainer.appendChild(bonusBox);

    // Disable virtual keyboard
    const buttons = keyboard.querySelectorAll("button");
    buttons.forEach(b => b.disabled = true);

    bonusInput = "";
}

// Listen for key presses in bonus mode
document.addEventListener("keydown", function(e) {
    if (!bonusMode) return;

    if (e.key === "Enter") {
        const typedWord = bonusInput.trim().toUpperCase().replace(/\s+/g, ' ');
        const correctWord = words[currentWordIndex].text.toUpperCase().replace(/\s+/g, ' ');

        if (typedWord === correctWord) {
            score += 100;
            logWordAttempt(true, true);
            Swal.fire({
                icon: "success",
                title: "🎉 Correct!",
                text: "+100 points (Bonus Card)",
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            score = Math.max(0, score - 30);
            logWordAttempt(false, true);
            Swal.fire({
                icon: "error",
                title: "❌ Wrong Guess",
                text: "-30 points",
                timer: 2000,
                showConfirmButton: false
            });
        }

        updateHUD();
        bonusMode = false;
        bonusInput = "";

        // Move to next word
        currentWordIndex++;
        if (currentWordIndex < words.length) {
            setTimeout(() => {
                renderWord();
                renderKeyboard();
            }, 2000);
        } else {
            endGame(true);
        }
    } else if (/^[a-zA-Z]$/.test(e.key) || e.key === " ") {
        // Only letters
        bonusInput += e.key.toUpperCase();
        document.getElementById("bonus-box").textContent = bonusInput;
    } else if (e.key === "Backspace") {
        bonusInput = bonusInput.slice(0, -1);
        document.getElementById("bonus-box").textContent = bonusInput;
    }
});

    // === Bind buttons ===
    document.getElementById("start-btn").addEventListener("click", restartGame);
    document.getElementById("restart-btn").addEventListener("click", restartGame);
    document.getElementById("bonus-btn").addEventListener("click", activateBonusCard);
});

</script>
@endpush
