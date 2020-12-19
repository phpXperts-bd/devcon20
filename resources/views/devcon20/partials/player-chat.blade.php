    <div class="sessionVideo">
      <div class="sessionVideo__container">
        <div class="sessionVideo__row">

          <div class="sessionVideo__videoWrapper">
            <div class="video">
              <span style="background-image: url({{ asset('devcon20/icons/youtube-logo.svg') }})"></span>
            </div>
          </div>

          <input type="radio" name="tabset" id="tab2" aria-controls="sessionChat" checked>
          <label for="tab2">
            <svg viewBox="0 0 32 32" width="16px" height="16px">
              <path id="Path_845" d="M26,2H6C3.8,2,2,3.8,2,6v22.7C2,29.4,2.6,30,3.4,30c0.3,0,0.6-0.1,0.8-0.3l6.5-5.1H26c2.2,0,4-1.8,4-4V6
                C30,3.8,28.2,2,26,2z M27.3,20.7c0,0.7-0.6,1.3-1.3,1.3H10.2c-0.3,0-0.6,0.1-0.8,0.3l-4.7,3.7V6c0-0.7,0.6-1.3,1.3-1.3h20
                c0.7,0,1.3,0.6,1.3,1.3V20.7z" />
            </svg>
            <span>Live chat</span>
          </label>
          <input type="radio" name="tabset" id="tab1" aria-controls="sessionInfo">
          <label for="tab1">
            <svg viewBox="0 0 32 32" width="16px" height="16px">
              <g>
                <rect x="14.4" y="14.4" class="st0" width="3.2" height="9.6" />
                <path d="M16,0C7.2,0,0,7.2,0,16s7.2,16,16,16s16-7.2,16-16S24.8,0,16,0z M16,28.8
                  C8.9,28.8,3.2,23.1,3.2,16S8.9,3.2,16,3.2S28.8,8.9,28.8,16c0,0,0,0,0,0C28.8,23.1,23.1,28.8,16,28.8z" />
                <rect x="14.4" y="8" class="st0" width="3.2" height="3.2" />
              </g>
            </svg>
            <span>Session info</span>
          </label>


          <div class="sessionVideo__sessionInfo">
            <div id="sessionInfo" class="sessionVideoInfo">
              <div class="wrapContent">
                <h1 class="heading">Co-variance & contra-variance in PHP</h1>
                <p class="timetime">9:45 am - 10-30 am</p>
                <p class="copy">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown.</p>
                <h2 class="title">Speaker</h2>
                <a class="speaker" href="#link" data-modal="SpeakerInfo-uniqueNumber">
                  <div class="speaker__image" style="background-image: url({{ asset('devcon20/images/a0-40x40@2x.jpg') }});"></div>
                  <div class="speaker__content">
                    <h3 class="speaker__name">Mizanur Rahman</h3>
                    <p class="speaker__copy">Founder & CEO, TechMasters</p>
                  </div>
                </a>
                <div class="speaker">
                  <div class="speaker__image"></div>
                  <div class="speaker__content">
                    <h3 class="speaker__name">Name</h3>
                    <p class="speaker__copy">Role, Company</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="sessionVideo__chatWrapper">
            <div id="sessionChat" class="sessionVideoChat">

              <div class="chatlayout">
                <div class="chatlayout__header">Live chat</div>
                <div class="chatlayout__body">
                  <div class="chat">
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Latest Mia</span>
                        <span class="chat__message">Hello from Dhaka</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Fahim Chowdhury</span>
                        <span class="chat__message">Hello All, Its wonderful day here from Rajshahi</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Hasan Rashed</span>
                        <span class="chat__message">Hi everyone!</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Rizon Rizon</span>
                        <span class="chat__message">Hello</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Sebastián Gómez</span>
                        <span class="chat__message">Hello from Uruguay!</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Antonis Mygiakis</span>
                        <span class="chat__message">Hello from Athens, Greece</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Md. Abdulllah</span>
                        <span class="chat__message">This is great! We can see people from all around the globe!</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Latest Mehedi Hasan Khan</span>
                        <span class="chat__message">Hello, does anyone else has the ad blocker issue?</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Kawser Ahmed</span>
                        <span class="chat__message">Hope it will not crash</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Masudul Islam</span>
                        <span class="chat__message">Good luck!</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Emam Sohel</span>
                        <span class="chat__message">Hi everyone</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Masudul Islam</span>
                        <span class="chat__message">Good luck!</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Oldest Zia</span>
                        <span class="chat__message">Soo cool</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chatlayout__footer">
                  <span class="textarea" role="textbox" contenteditable></span>
                  <button class="send">
                    <span class="send__svgWrapper">
                      <svg viewBox="0 0 32 32" width="16px" height="16px">
                        <path d="M30.2,12.7L6,0.3C5-0.3,3.8,0,3,0.9c-0.9,1-1.2,2.3-0.9,3.6l2.2,8.9l10.5,1.5c0.6,0.1,1,0.7,0.9,1.3
                          c-0.1,0.4-0.4,0.8-0.9,0.9L4.3,18.6l-2.2,8.9c-0.3,1.3,0.1,2.6,0.9,3.6c0.7,0.9,2,1.1,3,0.6l24.2-12.4c1.8-1.2,2.3-3.7,1.1-5.5
                          C31.1,13.4,30.7,13,30.2,12.7L30.2,12.7z" />
                      </svg>
                    </span>
                  </button>
                </div>
              </div>



              <!-- <div class="chat">
                <div class="chat__header">Live Chat</div>
                <div class="chat__body">
                  <div class="chat__wrapper">
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Pavel Chowdhury</span>
                        <span class="chat__message">Hello All, Its wonderful day here from Rajshahi</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Hasan Rashed</span>
                        <span class="chat__message">Hi everyone!</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Rizon Rizon</span>
                        <span class="chat__message">Hello</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Sebastián Gómez</span>
                        <span class="chat__message">Hello from Uruguay!</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Antonis Mygiakis</span>
                        <span class="chat__message">Hello from Athens, Greece</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Md. Abdulllah</span>
                        <span class="chat__message">This is great! We can see people from all around the globe!</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Latest Mehedi Hasan Khan</span>
                        <span class="chat__message">Hello, does anyone else has the ad blocker issue?</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Kawser Ahmed</span>
                        <span class="chat__message">Hope it will not crash</span>
                      </div>
                    </div>
                    <div class="chat__item">
                      <span class="chat__avatar"></span>
                      <div class="chat__content">
                        <span class="chat__name">Old Masudul Islam</span>
                        <span class="chat__message">Good luck!</span>
                      </div>
                    </div> 

                  </div>
                </div>
                <div class="chat__footer">
                  <span class="textarea" role="textbox" contenteditable></span>
                </div>
              </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>