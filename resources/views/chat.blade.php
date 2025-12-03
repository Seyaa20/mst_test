<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AI Chat Demo</title>

<style>
body {
    font-family: "Inter", Arial, sans-serif;
    margin: 0;
    background: #eef2f5;
}

.layout {
    display: flex;
    height: 100vh;
}

.sidebar {
    width: 300px;
    background: #fff;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    padding: 22px;
}

.sidebar h1 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 14px;
    margin-top: 0;
}

.search {
    padding: 15px 12px;
    border: 1px solid #dde3ea;
    border-radius: 10px;
    outline: none;
    margin-bottom: 20px;
    font-size: 14px;
    background: #f7f9fc;
}

.sidebar .search {
    width: 100%;
    box-sizing: border-box;
}

.contact-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
    overflow-y: auto;
    padding-right: 6px;
}

.contact {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 10px;
    border-radius: 12px;
    cursor: pointer;
    transition: .2s;
}

.contact:hover,
.contact.active {
    background: #f4f7fb;
}

.contact img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.name {
    font-size: 15px;
    font-weight: 600;
}

.last {
    font-size: 13px;
    color: #556;
}

.status {
    margin-left: auto;
    border: none;
    font-size: 11px;
    padding: 4px 10px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}

.status.open {
    background: #e6f7ec;
    color: #26a65b;
}

.status.date {
    color: #999;
}

.chat {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #f3f6fa;
}

.chat-header {
    position: sticky;
    top: 0;
    z-index: 99;
    background: #fff;
    padding: 10px 24px;
    display: flex;
    align-items: center;
    gap: 14px;
    border-bottom: 1px solid #e2e6ea;
}

.chat-header img {
    width: 46px;
    height: 46px;
    border-radius: 50%;
}

.chat-name {
    font-weight: 700;
    font-size: 17px;
}

.chat-body {
    flex: 1;
    overflow-y: auto;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 18px;
    scrollbar-width: thin;
    scrollbar-color: #cfd8e3 transparent;
}

.bubble {
    max-width: 60%;
    padding: 12px 16px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.45;
    position: relative;
}

.user {
    margin-left: auto;
    background: #2f80ff;
    color: white;
    border-bottom-right-radius: 4px;
}

.ai {
    margin-right: auto;
    background: #fff;
    color: #111;
    border-bottom-left-radius: 4px;
}

.time {
    font-size: 11px;
    color: #888;
    margin-top: 4px;
    text-align: right;
}

.chat-footer {
    display: flex;
    padding: 18px 24px;
    background: #fff;
    border-top: 1px solid #dde3ea;
    gap: 10px;
}

.chat-footer input {
    flex: 1;
    padding: 12px 16px;
    border-radius: 14px;
    border: 1px solid #cfd6dd;
    font-size: 14px;
    outline: none;
}

.chat-footer button {
    width: 44px;
    height: 44px;
    background: #0083ff;
    border: none;
    border-radius: 50%;
    font-size: 18px;
    color: white;
    cursor: pointer;
}

.input-wrapper {
    position: relative;
    flex: 1;
    display: flex;
    align-items: center;
    border: 1px solid #cfd6dd;
    background: #fff;
    border-radius: 48px;
    padding-right: 6px;
}

.input-wrapper input {
    padding-left: 55px !important;
    background: transparent !important;
    color: #111;
    padding-right: 42px !important;
}

.burger {
    position: absolute !important;
    left: 5px !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    font-size: 24px !important;
    font-weight: 600 !important;
    color: #9ca3af !important;
    background: transparent !important;
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    z-index: 9999 !important;
    cursor: pointer;
}

.menu-popup {
    position: absolute;
    bottom: 55px;
    left: 0;
    width: 160px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.15);
    display: none;
    flex-direction: column;
    overflow: hidden;
    z-index: 100;
}

.menu-popup label {
    padding: 12px 16px;
    cursor: pointer;
    font-size: 14px;
    border-bottom: 1px solid #f1f1f1;
}

.menu-popup label:hover {
    background: #f6faff;
}

.file-user,
.image-user,
.video-user {
    margin-left: auto;
    background: #2D7FF9;
    color: #fff;
    border-radius: 18px;
    padding: 10px 14px;
    max-width: 240px;
    display: inline-block;
    border-bottom-right-radius: 6px;
}

.time-user {
    font-size: 11px;
    color: rgba(255,255,255,0.8);
    text-align: right;
    margin-top: 4px;
}

.chat-top-title {
    position: relative;
    background: #ffffff;
    padding: 14px 24px;
    border-bottom: 1px solid #e5e7eb;
    font-weight: 700;
    font-size: 20px;
    color: #1e293b;
    text-align: center;
}

.back-btn {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    font-size: 22px;
    font-weight: 700;
    cursor: pointer;
    color: #1e293b;
    padding: 6px 10px;
    border-radius: 8px;
}

.chat-top-open {
    position: absolute;
    right: 18px;
    top: 50%;
    transform: translateY(-50%);
    background: #e6f7ec;
    color: #26a65b;
    border: none;
    font-size: 12px;
    padding: 5px 12px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}

.chat-top-title span {
    text-align: center;
}

.back-btn:hover {
    background: #f1f5f9;
}

.send-btn {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 30px;
    height: 30px;
    background: #0083ff;
    border: none;
    border-radius: 50%;
    font-size: 16px;
    color: white;
    cursor: pointer;
    z-index: 9999;
}

@media (max-width: 1024px) {
    .sidebar {
        display: none;
    }
    #back-btn {
        display: block;
    }
    .chat-top-title {
        grid-template-columns: 40px 1fr auto;
    }
}

@media (min-width: 1025px) {
    #back-btn {
        display: none;
    }
    .sidebar {
        display: block;
    }
}

@media (max-width: 768px) {
    .layout {
        flex-direction: column;
    }
    .sidebar {
        display: none;
    }
    .chat {
        width: 100%;
    }
    .chat-top-title,
    .chat-header {
        top: 0;
        z-index: 1000;
    }
    .chat-footer {
        position: sticky;
        bottom: 0;
        z-index: 1000;
        background: #fff;
    }
    .input-wrapper input {
        padding-left: 42px !important;
        padding-right: 38px !important;
        font-size: 14px;
    }
    .burger {
        font-size: 20px !important;
        left: 8px !important;
    }
    .send-btn {
        width: 28px;
        height: 28px;
        font-size: 14px;
    }
    .bubble {
        max-width: 80%;
    }
    .image-user img,
    .video-user video {
        max-width: 160px !important;
    }
}
</style>

</head>
<body>

<div class="layout">

    <div class="sidebar">
        <h1>Helpdesk Chat</h1>
        <input class="search" type="text" placeholder="Search">
        <div class="contact-list">
            <div class="contact active">
                <img src="https://i.pravatar.cc/40?img=8">
                <div class="info">
                    <div class="name">Cameron Williamson</div>
                    <div class="last">Can't log in</div>
                </div>
                <span class="status open">Open</span>
            </div>
            <div class="contact">
                <img src="https://i.pravatar.cc/40?img=10">
                <div class="info">
                    <div class="name">Kristin Watson</div>
                    <div class="last">Error message</div>
                </div>
                <span class="status date">Tue</span>
            </div>
            <div class="contact">
                <img src="https://i.pravatar.cc/40?img=5">
                <div class="info">
                    <div class="name">Kathryn Murphy</div>
                    <div class="last">Payment issue</div>
                </div>
                <span class="status date">Tue</span>
            </div>
            <div class="contact">
                <img src="https://i.pravatar.cc/40?img=12">
                <div class="info">
                    <div class="name">Ralph Edwards</div>
                    <div class="last">Account assis...</div>
                </div>
                <span class="status date">Mon</span>
            </div>
        </div>
    </div>

    <div class="chat">
        <div class="chat-top-title">
            <button id="back-btn" class="back-btn" onclick="showSidebar()">←</button>
            <span>Helpdesk Chat</span>
            <button class="chat-top-open">Open</button>
        </div>

        <div class="chat-header">
            <img src="https://i.pravatar.cc/50?img=8">
            <div>
                <div class="chat-name">Cameron Williamson</div>
            </div>
        </div>

        <div id="messages" class="chat-body"></div>

        <div class="chat-footer">
            <div class="input-wrapper">
                <button class="burger" onclick="toggleMenu()">≡</button>
                <input id="input" type="text" placeholder="Type a message...">
                <button class="send-btn" onclick="sendMessage()">➤</button>

                <div id="menu-popup" class="menu-popup">
                    <label onclick="pickFile('file')">📄 File</label>
                    <label onclick="pickFile('image')">🖼️ Image</label>
                    <label onclick="pickFile('video')">🎥 Video</label>
                </div>
            </div>

            <input type="file" id="file-input" style="display:none" accept=".pdf,.doc,.docx,.txt">
            <input type="file" id="image-input" style="display:none" accept="image/*">
            <input type="file" id="video-input" style="display:none" accept="video/*">
        </div>
    </div>

</div>

<script>
async function sendMessage() {
    const input = document.getElementById("input");
    let message = input.value.trim();
    if (!message) return;

    addMessage(message, "user");
    input.value = "";

    let loading = document.createElement("div");
    loading.className = "bubble ai";
    loading.innerText = "Typing...";
    document.getElementById("messages").appendChild(loading);

    const response = await fetch("/api/chat", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message })
    });

    const data = await response.json();
    loading.remove();

    addMessage(data.reply, "ai");
}

function addMessage(text, sender) {
    const messages = document.getElementById("messages");
    const wrap = document.createElement("div");

    const bubble = document.createElement("div");
    bubble.className = "bubble " + sender;
    bubble.innerText = text;

    const time = document.createElement("div");
    time.className = "time";
    time.innerText = new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });

    wrap.appendChild(bubble);
    wrap.appendChild(time);

    messages.appendChild(wrap);
    messages.scrollTop = messages.scrollHeight;
}

function toggleMenu() {
    const menu = document.getElementById("menu-popup");
    menu.style.display = (menu.style.display === "flex") ? "none" : "flex";
}

function pickFile(type) {
    const inputMap = {
        file: "file-input",
        image: "image-input",
        video: "video-input"
    };
    document.getElementById(inputMap[type]).click();
    toggleMenu();
}

document.getElementById("file-input").addEventListener("change", function () {
    handleFileBubble(this.files[0]);
});

document.getElementById("image-input").addEventListener("change", function () {
    handleImageBubble(this.files[0]);
});

document.getElementById("video-input").addEventListener("change", function () {
    handleVideoBubble(this.files[0]);
});

function handleFileBubble(file) {
    const messages = document.getElementById("messages");
    const div = document.createElement("div");
    div.className = "file-user";
    div.innerHTML = `
        📄 ${file.name}
        <div class="time-user">
            ${new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })}
        </div>
    `;
    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
}

function handleImageBubble(file) {
    const url = URL.createObjectURL(file);
    const messages = document.getElementById("messages");
    const div = document.createElement("div");
    div.className = "image-user";
    div.innerHTML = `
        <img src="${url}" style="max-width:220px;border-radius:14px;box-shadow:0 3px 10px rgba(0,0,0,0.15)">
        <div class="time-user">
            ${new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })}
        </div>
    `;
    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
}

function handleVideoBubble(file) {
    const url = URL.createObjectURL(file);
    const messages = document.getElementById("messages");
    const div = document.createElement("div");
    div.className = "video-user";
    div.innerHTML = `
        <video src="${url}" style="max-width:220px;border-radius:14px;" controls></video>
        <div class="time-user">
            ${new Date().toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })}
        </div>
    `;
    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
}

document.getElementById("input").addEventListener("keydown", function (e) {
    if (e.key === "Enter") {
        e.preventDefault();
        sendMessage();
    }
});
</script>

</body>
</html>
