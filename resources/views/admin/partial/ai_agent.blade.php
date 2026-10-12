@extends('admin.layout.view')

@section('header_title', 'AI Inventory Assistant')

@section('content')
<div class="container-fluid px-3 px-md-4 py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card bg-dark border-slate shadow-sm" style="border-radius: 12px; overflow: hidden; height: 80vh; display: flex; flex-direction: column;">
                
                <!-- Chat Header -->
                <div class="card-header bg-dark border-bottom border-slate p-3 d-flex align-items-center">
                    <div class="rounded-circle bg-accent text-white d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                        <i class="bi bi-robot fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 text-light fw-bold">InventoryBot</h5>
                        <small class="text-success"><i class="bi bi-circle-fill" style="font-size: 8px;"></i> Online</small>
                    </div>
                </div>

                <!-- Chat Body -->
                <div class="card-body p-3 overflow-auto" id="chatbox" style="flex: 1; background-color: #1a1d21;">
                    <!-- Initial Greeting -->
                    <div class="d-flex mb-3">
                        <div class="bg-slate p-3 rounded-3" style="max-width: 75%; border-bottom-left-radius: 0;">
                            <p class="mb-0 text-light">Namaste! Main InventoryBot hoon. Aapke Inventory Management System se related kisi bhi sawal mein main madad kar sakta hoon. Aap kya janna chahte hain?</p>
                        </div>
                    </div>
                </div>

                <!-- Chat Footer / Input -->
                <div class="card-footer bg-dark border-top border-slate p-3">
                    <form id="chatForm" class="d-flex align-items-center">
                        @csrf
                        <input type="text" id="chatInput" class="form-control border-slate rounded-pill ps-4 pe-4 py-2 me-2 bg-transparent text-light" placeholder="Apna sawal yahan likhein..." required>
                        <button type="submit" class="btn btn-accent rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;" id="sendBtn">
                            <i class="bi bi-send-fill text-white"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    /* Custom Scrollbar for Chatbox */
    #chatbox::-webkit-scrollbar {
        width: 6px;
    }
    #chatbox::-webkit-scrollbar-track {
        background: transparent;
    }
    #chatbox::-webkit-scrollbar-thumb {
        background: #343a40;
        border-radius: 10px;
    }
    .bg-slate {
        background-color: #2b3035 !important;
    }
    .btn-accent {
        background-color: #0d6efd; /* Adjust this to match your project's accent color */
        border-color: #0d6efd;
    }
    .bg-accent {
        background-color: #0d6efd !important;
    }
    .user-msg {
        background-color: #0d6efd; /* Accent color for user */
        color: white;
        border-bottom-right-radius: 0 !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chatForm = document.getElementById("chatForm");
        const chatInput = document.getElementById("chatInput");
        const chatbox = document.getElementById("chatbox");
        const sendBtn = document.getElementById("sendBtn");

        chatForm.addEventListener("submit", function(e) {
            e.preventDefault();
            const message = chatInput.value.trim();
            if (!message) return;

            // Append User Message
            appendMessage(message, 'user');
            chatInput.value = '';
            
            // Show Loading Indicator
            const loadingId = appendLoading();

            // Send to Server
            fetch("{{ route('ai_agent.chat') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                removeMessage(loadingId);
                appendMessage(data.reply, 'bot');
            })
            .catch(error => {
                removeMessage(loadingId);
                appendMessage("Maaf kijiye, abhi kuch technical samasya hai. Baad mein try karein.", 'bot');
                console.error("Error:", error);
            });
        });

        function appendMessage(text, sender) {
            const isUser = sender === 'user';
            const alignment = isUser ? 'justify-content-end' : '';
            const msgClass = isUser ? 'user-msg' : 'bg-slate';
            const radiusClass = isUser ? 'border-bottom-right-radius: 0;' : 'border-bottom-left-radius: 0;';
            
            // Format markdown basic (bold, linebreaks) if it's bot
            let formattedText = text;
            if (!isUser) {
                formattedText = formattedText.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                formattedText = formattedText.replace(/\n/g, '<br>');
            }

            const msgHtml = `
                <div class="d-flex mb-3 ${alignment}">
                    <div class="${msgClass} p-3 rounded-3 shadow-sm" style="max-width: 75%; ${radiusClass}">
                        <p class="mb-0 ${isUser ? 'text-white' : 'text-light'}">${formattedText}</p>
                    </div>
                </div>
            `;
            chatbox.insertAdjacentHTML('beforeend', msgHtml);
            scrollToBottom();
        }

        function appendLoading() {
            const id = 'loading-' + Date.now();
            const msgHtml = `
                <div class="d-flex mb-3" id="${id}">
                    <div class="bg-slate p-3 rounded-3 shadow-sm" style="max-width: 75%; border-bottom-left-radius: 0;">
                        <div class="d-flex align-items-center">
                            <div class="spinner-grow spinner-grow-sm text-secondary me-1" role="status"></div>
                            <div class="spinner-grow spinner-grow-sm text-secondary me-1" role="status" style="animation-delay: 0.2s;"></div>
                            <div class="spinner-grow spinner-grow-sm text-secondary" role="status" style="animation-delay: 0.4s;"></div>
                        </div>
                    </div>
                </div>
            `;
            chatbox.insertAdjacentHTML('beforeend', msgHtml);
            scrollToBottom();
            return id;
        }

        function removeMessage(id) {
            const el = document.getElementById(id);
            if (el) el.remove();
        }

        function scrollToBottom() {
            chatbox.scrollTop = chatbox.scrollHeight;
        }
    });
</script>
@endpush
