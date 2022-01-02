<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"> -->

    <script src="https://kit.fontawesome.com/6e0b87b468.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <div class="scene">
        <div class="ui-board">
            <div class="ui-bar">
                <div class="ui-btn">
                    <div class="figure figure-black">
                        <div class="chessCard">
                            <div class="card-top ">
                            </div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="chessboard">
            <div class="blackQuickActions blackQuickActions-hidden">
                <div class="figure figure-black">
                    <div class="chessCard">
                        <div class="card-top bg-menu-white">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>
                <div class="figure figure-black">
                    <div class="chessCard">
                        <div class="card-top bg-flag-white">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>
            </div>
            <div class="whiteQuickActions">
                <div class="figure figure-white">
                    <div class="chessCard">
                        <div class="card-top bg-menu">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>
                <div class="figure figure-white">
                    <div class="chessCard">
                        <div class="card-top bg-flag">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>

            </div>
            <div class="blackGraveyard blackGraveyard-shown">
                <div class="figure figure-black">
                    <div class="chessCard">
                        <div class="card-top bg-rook-white">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>
                <div class="figure figure-black">
                    <div class="chessCard">
                        <div class="card-top bg-rook-white">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>
                <div class="figure figure-black">
                    <div class="chessCard">
                        <div class="card-top bg-rook-white">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>
            </div>
            <div class="whiteGraveyard whiteGraveyard-shown">
                <div class="figure figure-white">
                    <div class="chessCard">
                        <div class="card-top bg-rook">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>
                <div class="figure figure-white">
                    <div class="chessCard">
                        <div class="card-top bg-rook">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>
                <div class="figure figure-white">
                    <div class="chessCard">
                        <div class="card-top bg-rook">
                        </div>
                        <div class="card-bot"></div>
                        <div class="card-left"></div>
                        <div class="card-right"></div>
                        <div class="card-front"></div>
                        <div class="card-back"></div>
                    </div>
                </div>
            </div>
            <div class="fieldMarksVertical">
                <div class="mark mark1">1</div>
                <div class="mark mark2">2</div>
                <div class="mark mark3">3</div>
                <div class="mark mark4">4</div>
                <div class="mark mark5">5</div>
                <div class="mark mark6">6</div>
                <div class="mark mark7">7</div>
                <div class="mark mark8">8</div>
            </div>
            <div class="fieldMarksHorizontal">
                <div class="bottomLeftBox"></div>
                <div class="bottomRightBox"></div>
                <div class="mark markA">A</div>
                <div class="mark markB">B</div>
                <div class="mark markC">C</div>
                <div class="mark markD">D</div>
                <div class="mark markE">E</div>
                <div class="mark markF">F</div>
                <div class="mark markG">G</div>
                <div class="mark markH">H</div>
            </div>
            <div class="fieldMarksVertical2">
                <div class="mark mark1">1</div>
                <div class="mark mark2">2</div>
                <div class="mark mark3">3</div>
                <div class="mark mark4">4</div>
                <div class="mark mark5">5</div>
                <div class="mark mark6">6</div>
                <div class="mark mark7">7</div>
                <div class="mark mark8">8</div>
            </div>
            <div class="fieldMarksHorizontal2">
                <div class="bottomLeftBox bg-black"></div>
                <div class="bottomRightBox bg-black"></div>
                <div class="mark markA">A</div>
                <div class="mark markB">B</div>
                <div class="mark markC">C</div>
                <div class="mark markD">D</div>
                <div class="mark markE">E</div>
                <div class="mark markF">F</div>
                <div class="mark markG">G</div>
                <div class="mark markH">H</div>
            </div>
            <div id="row1" class="row">
                <div tabindex="1" class="field">
                    <div class="figure figure-black figure-attack">
                        <div class="chessCard">
                            <div class="card-top bg-rook-white">
                            </div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="2" class="field">
                    <div class="figure figure-black">
                        <div class="chessCard">
                            <div class="card-top bg-knight-white"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="3" class="field">
                    <div class="figure figure-black">
                        <div class="chessCard">
                            <div class="card-top bg-bishop-white"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="4" class="field"></div>
                <div tabindex="5" class="field">
                    <div class="figure figure-black">
                        <div class="chessCard">
                            <div class="card-top bg-king-white"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="6" class="field"></div>
                <div tabindex="7" class="field"></div>
                <div tabindex="8" class="field"></div>
            </div>
            <div id="row2" class="row">
                <div tabindex="9" class="field">
                    <div class="figure figure-black">
                        <div class="chessCard">
                            <div class="card-top bg-pawn-white"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="10" class="field"></div>
                <div tabindex="11" class="field"></div>
                <div tabindex="12" class="field">
                    <div class="figure figure-black">
                        <div class="chessCard">
                            <div class="card-top bg-queen-white"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>

                <div tabindex="13" class="field"></div>
                <div tabindex="14" class="field"></div>
                <div tabindex="15" class="field"></div>
                <div tabindex="16" class="field">
                    <div class="figure figure-black">
                        <div class="chessCard">
                            <div class="card-top bg-pawn-white"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="row3" class="row">
                <div tabindex="17" class="field"></div>
                <div tabindex="18" class="field"></div>
                <div tabindex="19" class="field"></div>
                <div tabindex="20" class="field"></div>

                <div tabindex="21" class="field"></div>
                <div tabindex="22" class="field"></div>
                <div tabindex="23" class="field"></div>
                <div tabindex="24" class="field"></div>
            </div>
            <div id="row4" class="row">
                <div tabindex="25" class="field"></div>
                <div tabindex="26" class="field"></div>
                <div tabindex="27" class="field"></div>
                <div tabindex="28" class="field"></div>

                <div tabindex="29" class="field"></div>
                <div tabindex="30" class="field"></div>
                <div tabindex="31" class="field"></div>
                <div tabindex="32" class="field"></div>
            </div>
            <div id="row5" class="row">
                <div tabindex="33" class="field"></div>
                <div tabindex="34" class="field"></div>
                <div tabindex="35" class="field"></div>
                <div tabindex="36" class="field"></div>

                <div tabindex="37" class="field"></div>
                <div tabindex="38" class="field"></div>
                <div tabindex="39" class="field"></div>
                <div tabindex="40" class="field"></div>
            </div>
            <div id="row6" class="row">
                <div tabindex="41" class="field"></div>
                <div tabindex="42" class="field"></div>
                <div tabindex="43" class="field">
                        <div class="figure figure-black">
                            <div class="chessCard">
                                <div class="card-top bg-knight-white"></div>
                                <div class="card-bot"></div>
                                <div class="card-left"></div>
                                <div class="card-right"></div>
                                <div class="card-front"></div>
                                <div class="card-back"></div>
                            </div>
                        </div>
                </div>
                <div tabindex="44" class="field">
                    <div class="figure figure-white">
                        <div class="chessCard">
                            <div class="card-top bg-queen"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>

                <div tabindex="45" class="field"></div>
                <div tabindex="46" class="field"></div>
                <div tabindex="47" class="field">
                    <div class="figure figure-black">
                        <div class="chessCard">
                            <div class="card-top bg-rook-white">
                            </div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="48" class="field">
                    <div class="figure figure-white">
                        <div class="chessCard">
                            <div class="card-top bg-pawn"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="row7" class="row">
                <div tabindex="49" class="field"></div>
                <div tabindex="50" class="field"></div>
                <div tabindex="51" class="field"></div>
                <div tabindex="52" class="field"></div>

                <div tabindex="53" class="field"></div>
                <div tabindex="54" class="field"></div>
                <div tabindex="55" class="field"></div>
                <div tabindex="56" class="field">
                    <div class="figure figure-white">
                        <div class="chessCard">
                            <div class="card-top bg-pawn"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="row8" class="row">
                <div tabindex="57" class="field">
                    <div class="figure figure-white">
                        <div class="chessCard">
                            <div class="card-top bg-rook">
                            </div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="58" class="field">
                    <div class="figure figure-white">
                        <div class="chessCard">
                            <div class="card-top bg-knight"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="59" class="field">
                    <div class="figure figure-white">
                        <div class="chessCard">
                            <div class="card-top bg-bishop"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="60" class="field"></div>

                <div tabindex="61" class="field">
                    <div class="figure figure-white">
                        <div class="chessCard">
                            <div class="card-top bg-king"></div>
                            <div class="card-bot"></div>
                            <div class="card-left"></div>
                            <div class="card-right"></div>
                            <div class="card-front"></div>
                            <div class="card-back"></div>
                        </div>
                    </div>
                </div>
                <div tabindex="62" class="field"></div>
                <div tabindex="63" class="field"></div>
                <div tabindex="64" class="field"></div>
            </div>
        </div>
    </div>

    <script src="./selector.js"></script>

</body>

</html>