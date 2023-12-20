//creation of the on/off switch
// Create the label element
let label = document.createElement("label");
label.className = "switchFlash";

// Create the input element
let input = document.createElement("input");
input.type = "checkbox";

// Create the span element
let span = document.createElement("span");
span.className = "slider round";

// Append the input and span elements to the label
label.appendChild(input);
label.appendChild(span);
document.body.appendChild(label);

let keepGoing = true

// Simulate a space key press
// Fix to trigger eventlisteners
const spaceKeyPress = new KeyboardEvent('keydown', {
    key: ' ',
    bubbles: true,
    cancelable: true,
    code: 'Space',
    keyCode: 32,
});

document.addEventListener('paste', function(event) {
        // Prevent the default paste behavior
        event.preventDefault();

        // Handle the paste event
        // console.log(event.clipboardData.getData('text'));
        text = event.clipboardData.getData('text')
        question = text.split("a.");
        questionHolder = document.querySelector('.question').querySelector('p')
        questionHolder.innerHTML = question[0]
        questionHolder.dispatchEvent(spaceKeyPress);

        var lines = text.split('\n');

    var answerA, answerB, answerC, answerD, answerCorrect;
    var answerCount = 0
        //fix for questions with images
        var fixImage;
    //fix for format issue and empty lines
    var answerAEmpty = false;
    var answerBEmpty = false;
    var answerCEmpty = false;
    var answerDEmpty = false;

    //get answers into variables
    for (var i = 0; i < lines.length; i++) {
        var line = lines[i].trim();  // Trim to remove leading and trailing whitespaces
        console.log(line);
        if (!line.startsWith("a.") && !line.startsWith("b.") && !line.startsWith("c.") && !line.startsWith("d.")&& !line.startsWith("ANS") && line.trim() != question[0].trim()) {
            fixImage = line;
            console.log('condition',line);
            // console.log(question[0])
            // console.log('here')
            // if (!answerA) {
            //     answerA = line;
            // }else if (!answerB) {
            //     answerB = line
            // }else if (!answerC) {
            //     answerC = line
            // }else if (!answerD) {
            //     answerD = line
            // }
        }
        if (answerAEmpty && !line.startsWith("b.") && !line.startsWith("c.") && !line.startsWith("d.") && !line.startsWith("ANS")) {
            answerA = line;
            answerAEmpty = false;
        } else if (line.startsWith("a.")) {
            line = line.replace("a.", "").trim();
            answerCount++
            if (line !== '') {
                answerA = line;
            } else {
                answerAEmpty = true;
            }
        }

        if (answerBEmpty && !line.startsWith("a.") && !line.startsWith("c.") && !line.startsWith("d.") && !line.startsWith("ANS")) {
            answerB = line;
            answerBEmpty = false;
        } else if (line.startsWith("b.")) {
            line = line.replace("b.", "").trim();
            answerCount++
            if (line !== '') {
                answerB = line;
            } else {
                answerBEmpty = true;
            }
        }

        if (answerCEmpty && !line.startsWith("b.") && !line.startsWith("a.") && !line.startsWith("d.") && !line.startsWith("ANS")) {
            // console.log(line)
            answerC = line;
            answerCEmpty = false;
        } else if (line.startsWith("c.")) {
            line = line.replace("c.", "").trim();
            answerCount++
            if (line !== '') {
                answerC = line;
            } else {
                answerCEmpty = true;
            }
        }

        if (answerDEmpty && !line.startsWith("b.") && !line.startsWith("c.") && !line.startsWith("a.") && !line.startsWith("ANS")) {
            answerD = line;
            answerDEmpty = false;
        } else if (line.startsWith("d.")) {
            line = line.replace("d.", "").trim();
            answerCount++
            if (line !== '') {
                answerD = line;
            } else {
                answerDEmpty = true;
            }
        }

        if (line.startsWith("ANS: ")) {
            answerCorrect = line.replace("ANS: ", "").trim();
        }
    }
//fix format images
    if (!answerA && fixImage) {
        answerA = fixImage;
    }else if (!answerB && fixImage) {
        answerB = fixImage;
    }else if (!answerC && fixImage) {
        answerC = fixImage;
    }else if (!answerD && fixImage) {
        answerD = fixImage;
    }
    console.log('a: ',answerA);
    console.log('b: ',answerB);
    console.log('c: ',answerC);
    console.log('d: ',answerD);
    console.log('acorrect: ',answerCorrect);

    //add answer if needed

    moreAnswers = document.querySelector('.create-flashcard-more-options-add-answer')
    console.log(answerCount)
    //add the answers' boxes
    for (let index = 1; index < answerCount; index++) {
        moreAnswers.click()
    }
    
    // answersWrapper = document.querySelector('[formarrayname="answers"]')
    // console.log(answersWrapper)

    // Wait that the boxes are added to the DOM
    // fix ajax
    setTimeout(function() {
        // Add the answers to the boxes
        answersElements = document.querySelectorAll('.answer p');
        console.log(answersElements);
        answersElements.forEach(element => {
            if (answerA) {
                element.innerHTML = answerA;
                element.dispatchEvent(spaceKeyPress);
                if(!correctAnswerContains('A', answerCorrect)){
                   answerHeader = element.closest('#answer-area').previousSibling
                   console.log(answerHeader)
                   answerHeader.querySelector('.switch').click()           
                }
                answerA = '';
                
            }
            else if (answerB) {
                element.innerHTML = answerB;
                element.dispatchEvent(spaceKeyPress);
                if(correctAnswerContains('B', answerCorrect)){
                    answerHeader = element.closest('#answer-area').previousSibling
                    console.log(answerHeader)
                    answerHeader.querySelector('.switch').click()          
                   
                 }
                answerB = '';
            }
            else if (answerC) {
                element.innerHTML = answerC;
                element.dispatchEvent(spaceKeyPress);
                if(correctAnswerContains('C', answerCorrect)){
                    answerHeader = element.closest('#answer-area').previousSibling
                    console.log(answerHeader)
                    answerHeader.querySelector('.switch').click()          
                   
                 }
                answerC = '';
            }
            else if (answerD) {
                element.innerHTML = answerD;
                element.dispatchEvent(spaceKeyPress);
                if(correctAnswerContains('D', answerCorrect)){
                    answerHeader = element.closest('#answer-area').previousSibling
                    console.log(answerHeader)
                    answerHeader.querySelector('.switch').click()          
                   
                 }
                answerD = '';
            }
        });
    }, 500); // Adjust the delay as needed

});
function correctAnswerContains(numberToCheck, answer){
    if(numberToCheck == answer){
        return true
    }else  { return false }
}


// let keepGoing = true

// let rdmNumber = document.createElement("p");
// rdmNumber.innerHTML = "Random";
// rdmNumber.id = "rdm";
// document.body.appendChild(rdmNumber);

// let btnAdd = document.createElement("button");
// btnAdd.innerHTML = "Ajout";
// btnAdd.type = "submit";
// btnAdd.name = "addLinkedinAuto";
// btnAdd.id = "btnAdd";
// btnAdd.onclick = function () {
//     keepGoing = true
//     var buttons = document.querySelectorAll('.artdeco-modal__content footer .artdeco-button__text');
//     var index = 0;
//     function timeOut() {
//         if (keepGoing === true && isModalOpen()==true) {
//             setTimeout(() => {
//                 if (buttons[index] == undefined) {
//                     buttons = document.querySelectorAll('.artdeco-modal__content footer .artdeco-button__text');
//                 }
//                 buttons[index++].click();
//                 timeOut()
//             }, random(1000, 2000))
//         } else {
//             rdmNumber.innerHTML = "Arrêt";
//         }
//     }
//     timeOut()
// };

// document.body.appendChild(btnAdd);

// let btnDelete = document.createElement("button");
// btnDelete.innerHTML = "Supprime";
// btnDelete.type = "submit";
// btnDelete.name = "addLinkedinAuto";
// btnDelete.id = "btnDelete";
// btnDelete.onclick = function () {
//     keepGoing = true
//     var buttons = document.querySelectorAll('.invitation-card__action-container .artdeco-button__text')
//     buttons
//     var index = 0;
//     function timeOutDel() {
//         if (keepGoing === true) {
//             setTimeout(() => {
//                 if (buttons[index] == undefined) {
//                     buttons = document.querySelectorAll('.invitation-card__action-container .artdeco-button__text');
//                 }
//                 buttons[index++].click();
//                 setTimeout(() => { document.querySelector('.artdeco-modal--layer-confirmation .artdeco-button--primary').click(); }, 1000);
//                 timeOutDel()
//             }, random(4000, 9000))
//         }
//     }
//     timeOutDel()
// };
// document.body.appendChild(btnDelete);


// let stop = document.createElement("button");
// stop.innerHTML = "Stop";
// stop.type = "submit";
// stop.id = "stop";
// stop.onclick = function () {
//     keepGoing = false
//     rdmNumber.innerHTML = "Arrêt";
//     rdmNumber.classList.remove('timer')
// }
// document.body.appendChild(stop);

// function random() {
//     min = inputSliderMin.value * 1000
//     console.log(min)
//     max = inputSliderMax.value * 1000
//     console.log(max)
//     let rdm = 0

//     rdm = Math.floor(Math.random() * (max - min + 1) + min)
//     rdm = Math.floor(rdm/100)*100; //arrondir ex : 5112 > 5100 
//     decreaseTimer(rdm)
//     console.log(rdm)
//     return rdm
// }
// function decreaseTimer(timer){
//         rdmNumber.classList.add('timer')
//         rdmNumber.innerHTML = timer;
//         let chrono = setInterval(() => {
//             if (keepGoing === true) {
//                 if (timer<100) {
//                     rdmNumber.innerHTML = 0;
//                     clearInterval(chrono);
//                 }else {
//                     timer -= 100;
//                     rdmNumber.innerHTML = timer;
//                 }   
//             } else {
//                 clearInterval(chrono);
//             }     
                
//         }, 100);
    
// }

// let containerSliderMax = document.createElement("div");
// containerSliderMax.classList.add('containerSliderMax');
// containerSliderMax.classList.add('flex');
// containerSliderMax.setAttribute('title', 'Interval maximum');
// document.body.appendChild(containerSliderMax);

// let labelSliderMax = document.createElement("label");
// labelSliderMax.classList.add('labelSliderMax');
// labelSliderMax.innerHTML = "5s"
// containerSliderMax.appendChild(labelSliderMax);

// let inputSliderMax = document.createElement("input")
// inputSliderMax.classList.add('inputSlider');
// inputSliderMax.type = "range";
// inputSliderMax.value = 5;
// inputSliderMax.max = 12;
// inputSliderMax.min = 0;
// inputSliderMax.step = 1;
// inputSliderMax.oninput = function () {
    
//     if (parseInt(this.value) < parseInt(inputSliderMin.value)) {
//         inputSliderMin.value = this.value;
//         labelSliderMin.innerHTML = inputSliderMax.value + "s";
//     }
//     labelSliderMax.innerHTML = this.value + "s";
    
// }


// containerSliderMax.appendChild(inputSliderMax);

// let btnSetting =document.createElement("div");
// btnSetting.classList.add('btnSettings');
// containerSliderMax.appendChild(btnSetting);

// btnSetting.addEventListener('click', function(event) {
//     containerSliderMax.classList.toggle('clicked');
// });

// //interval minimum
// let containerSliderMin = document.createElement("div");
// containerSliderMin.classList.add('containerSliderMin');
// containerSliderMin.classList.add('flex');
// containerSliderMin.setAttribute('title', 'Interval minimum');
// document.body.appendChild(containerSliderMin);

// let labelSliderMin = document.createElement("label");
// labelSliderMin.classList.add('labelSliderMin');
// labelSliderMin.innerHTML = "3s"
// containerSliderMin.appendChild(labelSliderMin);

// let inputSliderMin = document.createElement("input")
// inputSliderMin.classList.add('inputSlider');
// inputSliderMin.type = "range";
// inputSliderMin.value = 3;
// inputSliderMin.max = 12;
// inputSliderMin.min = 0;
// inputSliderMin.step = 1;
// inputSliderMin.oninput = function () {
//     console.log(this.value)
//     console.log(inputSliderMax.value)
//     if (parseInt(this.value) > parseInt(inputSliderMax.value)) {
//         inputSliderMax.value = this.value;
//         console.log('in loop')
//     }
//     labelSliderMin.innerHTML = this.value + "s";
//     labelSliderMax.innerHTML = inputSliderMax.value + "s";
// }
// containerSliderMin.appendChild(inputSliderMin);

// let btnSettingMin =document.createElement("div");
// btnSettingMin.classList.add('btnSettings');
// containerSliderMin.appendChild(btnSettingMin);
// // /
// btnSettingMin.addEventListener('click', function(event) {
//   containerSliderMin.classList.toggle('clicked');
// });

// function isModalOpen(){
//     // console.log(document.body.classList.contains("artdeco-modal-is-open"))
//    return document.body.classList.contains("artdeco-modal-is-open")
// }

