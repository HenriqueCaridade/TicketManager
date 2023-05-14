
// FAQ DROPDOWN
var elements = document.getElementsByClassName("faq-question");
for (let element of elements) {
    let parent = element.parentElement;
    let answerBlock = parent.getElementsByClassName("faq-answer-block")[0];
    let answer = answerBlock.getElementsByClassName("faq-answer")[0];
    answerBlock.style.maxHeight = 0; // Start Closed
    element.addEventListener("click", function() {
        parent.classList.toggle('faq-collapsed');
        if (parent.classList.contains('faq-collapsed')) {
            answerBlock.style.maxHeight = 0;
        } else {
            answerBlock.style.maxHeight = answer.clientHeight + 'px';
        }
    });
}
