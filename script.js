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
        var fixImage2;
    //fix for format issue and empty lines
    var answerAEmpty = false;
    var answerBEmpty = false;
    var answerCEmpty = false;
    var answerDEmpty = false;


    //get answers into variables
    for (var i = 0; i < lines.length; i++) {
        var line = lines[i].trim();  // Trim to remove leading and trailing whitespaces
        console.log(line);
        if (!line.startsWith("a.") && !line.startsWith("b.") && !line.startsWith("c.") && !line.startsWith("d.")&& !line.startsWith("ANS") && line.trim() != question[0].trim()&& !answerAEmpty && !answerBEmpty && !answerCEmpty && !answerDEmpty) {
            if (!fixImage && question) {
                fixImage = line;
            }else if (!fixImage2 && question) {
                fixImage2 = line;
            }
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

        else if (answerBEmpty && !line.startsWith("a.") && !line.startsWith("c.") && !line.startsWith("d.") && !line.startsWith("ANS")) {
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

        else if (answerCEmpty && !line.startsWith("b.") && !line.startsWith("a.") && !line.startsWith("d.") && !line.startsWith("ANS")) {
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

        else if (answerDEmpty && !line.startsWith("b.") && !line.startsWith("c.") && !line.startsWith("a.") && !line.startsWith("ANS")) {
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
    
    //case true false
    var bool = false
    if (answerCount < 2) {
        question = text.split("ANS");
        questionHolder = document.querySelector('.question').querySelector('p')
        questionHolder.innerHTML = question[0]
        questionHolder.dispatchEvent(spaceKeyPress);
        answerCount=2
        bool = true
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

    if (!answerA && fixImage2) {
        answerA = fixImage2;
    }else if (!answerB && fixImage2) {
        answerB = fixImage2;
    }else if (!answerC && fixImage2) {
        answerC = fixImage2;
    }else if (!answerD && fixImage2) {
        answerD = fixImage2;
    }
    console.log('a: ',answerA);
    console.log('b: ',answerB);
    console.log('c: ',answerC);
    console.log('d: ',answerD);
    console.log('FIX IMAGE: ',fixImage);
    console.log('FIX IMAGE2: ',fixImage2);
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
        answersElements = document.querySelectorAll('.answer p')
        if (!bool) {
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
        }else {
            trueAnswer = answersElements[0]
            trueAnswer.innerHTML = 'True'
            trueAnswer.dispatchEvent(spaceKeyPress);

            
            falseAnswer = answersElements[1]
            falseAnswer.innerHTML = 'False'
            falseAnswer.dispatchEvent(spaceKeyPress);

            if(!correctAnswerContains('T', answerCorrect)){ 
                console.log('false')
                answerHeaderTrue = trueAnswer.closest('#answer-area').previousSibling
                answerHeaderTrue.querySelector('.switch').click()

                answerHeaderFalse = falseAnswer.closest('#answer-area').previousSibling
                answerHeaderFalse.querySelector('.switch').click()
             }
             else {
                console.log('true')
             }

            
        }
    }, 500); // Adjust the delay as needed

});
function correctAnswerContains(numberToCheck, answer) {
    console.log(numberToCheck)
    console.log(answer)

    // Multi answers
    if (answer) {
        if (answer.includes(',')) {
            const answers = answer.split(',');
            return answers.some(element => element.trim() === numberToCheck);
        } else {
            // Single answer check
            return numberToCheck === answer.trim();
        }
    }
}
