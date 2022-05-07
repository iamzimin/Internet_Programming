let IdFirstDiv = 0;
let IdSecondDiv = 0;
let FirstNumberImage = 0;
let SecondNumberImage = 0;
let FirstDivImage = "";
let SecondDivImage = "";

let FirstIndexI = 0;
let FirstIndexJ = 0;
let SecondIndexI = 0;
let SecondIndexJ = 0;
let clicks = 1;
let openImages = 0;
let firstOrSecond = true;
let error = false;
let onlyOne = true;



//Создание матрицы
let table = new Array(4);
let finishedCards = new Array(4);
for(let i = 0; i < table.length; i++) {
    table[i] = new Array(6);
    finishedCards[i] = new Array(6);
}

//Заполнение матрицы
for(let row = 0; row < table.length; row++) {
    for (let col = 0; col < table[row].length; col++) {
        table[row][col] = 0;
        finishedCards[row][col] = 0;
    }
}


let usedNumber = new Array(24); let z = 0;
let usedIndex = new Array(24);
for (let c = 1; c <= 24; c++)
    usedIndex[c] = c;
let countIndex = 0;
let a = 0, b = 0;

for (let i = 0; i < table.length; i++) {
    for (let j = 0; j < table[i].length; j++) {
        if (table[i][j] == 0 && !(usedIndex.includes(i,j))) {

            let randomNumber = getRandomInt(1, 24);

            while (usedNumber.includes(randomNumber))
                randomNumber = getRandomInt(1, 24);

            usedNumber[z] = randomNumber; z++;
            table[i][j] = randomNumber;
            let tempNumber = table[i][j];

            let prevIndex = usedIndex.indexOf(IndexToNumber(i,j)); //удаление использовонного idшника
            usedIndex.splice(prevIndex, 1);

            let flag = true;
            while (flag) {
                a = getRandomInt(0, 4);
                b = getRandomInt(0, 6);
                let index = IndexToNumber(a,b);
                flag = false;
                if (!(usedIndex.includes(index)))
                    flag = true;
            }

            let currentIndex = usedIndex.indexOf(IndexToNumber(a,b)); //удаление использовонного idшника
            usedIndex.splice(currentIndex, 1);

            table[a][b] = tempNumber;
        }

    }

}

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min; //Максимум не включается, минимум включается
}

function IndexToNumber(i, j) {
    if (i == 0 && j == 0)
        return 1;

    let result = 0;
    i *= 6;
    j += 1;

    result = i + j;
    return result;
}

function arrayToString(arr){
    let x = " ";
    let y = "\n";
    let b = arr[0].join(x);
    for(let i = 1; i < arr.length; i++)
        b += y + arr[i].join(x);

    return b;
}

function getClickedElement(e) {
        document.body.onclick = function (e) {
            let elem = e ? e.target : window.event.srcElement;
            while (!(elem.id || (elem == document.body))) elem = elem.parentNode;
            if (!elem.id) return; else id = elem.id;
            id = id.replace(/\D/g, '');
            //alert(id);

            upload();


            if (firstOrSecond) {
                IdFirstDiv = id;
                ShowIdFirstDiv();
            } else {
                IdSecondDiv = id;
                ShowIdSecondDiv();
                if (!error)
                    checkDiv();
            }
        }
        document.getElementById("output").innerText = arrayToString(table);
        document.getElementById("output2").innerText = arrayToString(finishedCards);
        document.getElementById("steps").innerText = "Вы сделали " + clicks + " клик(а)(ов)";


    /*if (GameOver()) {
        $('[id^="ImageGame-"]').on('click', function(){
            let txt = clicks;
            $.ajax({
                url: 'MyWorks.php',
                type: 'POST',
                data: {
                    'txt': txt
                }
            });
        })
    }*/
}

function GameOver() {
    for(let row = 0; row < finishedCards.length; row++)
        for (let col = 0; col < finishedCards[row].length; col++)
            if (finishedCards[row][col] == 0)
                return false;
    return true;
}



function ShowIdFirstDiv() {

    let x = IdFirstDiv;
    let i = 0;
    let j = 0;
    while (x > 6) {
        i++;
        x -= 6;
    }
    if ((x % 6) != 0) {
        j = (x % 6) - 1;
    } else {
        j = table[1].length - 1;
    }

    if (finishedCards[i][j] == 0 /*&& SecondIndexI != FirstIndexI && FirstIndexJ != SecondIndexJ*/) {
        let div = "ImageGame-" + IdFirstDiv;
        let path = "../images/game/WhiteSqrtImage-" + table[i][j] + ".jpg";
        FirstDivImage = div;
        FirstNumberImage = table[i][j];
        //FirstPathImage = path;
        FirstIndexI = i;
        FirstIndexJ = j;
        clicks++;

        firstOrSecond = false;
        document.getElementById(div).src = path;
    }
}

function ShowIdSecondDiv() {
    error = false;
    let x = IdSecondDiv;
    let i = 0;
    let j = 0;
    while (x > 6) {
        i++;
        x -= 6;
    }
    if ((x % 6) != 0) {
        j = (x % 6) - 1;
    } else {
        j = table[1].length - 1;
    }

    if (IdFirstDiv == IdSecondDiv || finishedCards[i][j] == 1) {
        //firstOrSecond = true;
        //replace2White();
        error = true;
        //clicks++;
        return;
    }




    if (finishedCards[i][j] == 0 /*&& SecondIndexI != FirstIndexI && FirstIndexJ != SecondIndexJ*/) {
        let div = "ImageGame-" + IdSecondDiv;
        let path = "../images/game/WhiteSqrtImage-" + table[i][j] + ".jpg";
        SecondDivImage = div;
        SecondNumberImage = table[i][j];
        //SecondPathImage = path;
        SecondIndexI = i;
        SecondIndexJ = j;
        clicks++;

        firstOrSecond = true;
        document.getElementById(div).src = path;
    }
}


function checkDiv() {

    if ((FirstNumberImage != SecondNumberImage) && (finishedCards[FirstIndexI][FirstIndexJ] == 0 && finishedCards[SecondIndexI][SecondIndexJ] == 0))
        setTimeout(replace2White, 100);
    else if ((FirstNumberImage != SecondNumberImage) && finishedCards[SecondIndexI][SecondIndexJ] == 0) {
        setTimeout(replace1White, 100);
    }
    else if ((FirstNumberImage == SecondNumberImage) && (finishedCards[FirstIndexI][FirstIndexJ] == 0 && finishedCards[SecondIndexI][SecondIndexJ] == 0)){
        finishedCards[FirstIndexI][FirstIndexJ] = 1;
        finishedCards[SecondIndexI][SecondIndexJ] = 1;
        IdFirstDiv = 0;
        IdSecondDiv = 0;
        FirstNumberImage = 0;
        SecondNumberImage = 0;
        FirstDivImage = "";
        SecondDivImage = "";

        FirstIndexI = 0;
        FirstIndexJ = 0;
        SecondIndexI = 0;
        SecondIndexJ = 0;
    }

    if (GameOver()) {
        alert("Вы закончили игру за " + clicks + " шага(ов)");

        let txt = clicks;
        $.ajax({
            url: 'MyWorks.php',
            type: 'POST',
            data: {
                'txt': txt
            }
        });
    }
}
function replace2White() {
    let path = "../images/game/WhiteSqrtImage.jpg";
    document.getElementById(FirstDivImage).src = path;
    document.getElementById(SecondDivImage).src = path;
}

function replace1White() {
    let path = "../images/game/WhiteSqrtImage.jpg";
    document.getElementById(SecondDivImage).src = path;
}


function upload() {
    /*$(document).on('click', '#ImageGame-1', function () {
        let txt = clicks;
        $.ajax({
            url: 'MyWorks.php',
            type: 'POST',
            data: txt,
            success: function (data) {
                $('p.out').text(data);
            },
            error: function () {
                console.log('ERROR');
            }
        })
    })*/


}




