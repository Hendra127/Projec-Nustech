<div id="chat-box" style="height:300px; overflow-y:auto;"></div>

<input type="text" id="name" placeholder="Nama (opsional)">
<input type="text" id="message">
<button onclick="sendMessage()">Kirim</button>
<script src="/js/app.js"></script>

<script>
fetch('/chat/messages')
.then(res => res.json())
.then(data => {
    data.reverse().forEach(addMessage);
});

function sendMessage() {
    fetch('/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            sender_name: document.getElementById('name').value,
            message: document.getElementById('message').value
        })
    });
}

function addMessage(chat) {
    document.getElementById('chat-box').innerHTML +=
        `<div><b>${chat.sender_name}</b>: ${chat.message}</div>`;
}
</script>
