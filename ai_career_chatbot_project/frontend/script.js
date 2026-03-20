function sendMessage() {
    let input = document.getElementById("userInput");
    let message = input.value.trim();
    if (message === "") return;

    addMessage(message, "user");
    input.value = "";

    setTimeout(() => {
        addMessage("I'm your AI Career Guide. How can I help you today? 🤖", "bot");
    }, 800);
}

function addMessage(text, type) {
    let chatbox = document.getElementById("chatbox");
    let msg = document.createElement("div");
    msg.classList.add("message", type);
    msg.innerText = text;
    chatbox.appendChild(msg);
    chatbox.scrollTop = chatbox.scrollHeight;
}

document.getElementById("userInput")
.addEventListener("keypress", function(e) {
    if (e.key === "Enter") {
        sendMessage();
    }
});
