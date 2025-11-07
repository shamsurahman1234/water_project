<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-700">📸 Scan Meter ({{ $meter->customer->name }})</h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6 space-y-4">
            <p class="text-gray-700">Use your phone’s camera to scan the meter reading. The system will automatically detect the digits.</p>

            <video id="video" autoplay playsinline class="w-full border rounded"></video>
            <canvas id="canvas" style="display:none;"></canvas>

            <button id="captureBtn" class="bg-blue-600 text-white px-4 py-2 rounded">📸 Capture Reading</button>

            <label class="block mt-4 text-gray-700">OCR Result:</label>
            <textarea id="ocrResult" class="w-full border rounded p-2" rows="3" readonly></textarea>

            <label class="block mt-4 text-gray-700">Correct (if needed):</label>
            <input id="manualInput" type="text" class="w-full border rounded p-2" placeholder="e.g. 123.45" />

            <button id="sendBtn" class="mt-4 bg-green-600 text-white px-4 py-2 rounded">✅ Save Reading</button>

            <div id="status" class="mt-4 text-sm"></div>
        </div>
    </div>

    {{-- ✅ OCR Library --}}
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@4.0.2/dist/tesseract.min.js"></script>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureBtn = document.getElementById('captureBtn');
        const ocrResult = document.getElementById('ocrResult');
        const manualInput = document.getElementById('manualInput');
        const sendBtn = document.getElementById('sendBtn');
        const statusDiv = document.getElementById('status');

        async function startCamera() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                video.srcObject = stream;
            } catch (err) {
                statusDiv.innerText = "⚠️ Camera access failed: " + err.message;
            }
        }

        startCamera();

        captureBtn.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            const image = canvas.toDataURL('image/png');
            processOCR(image);
        });

        async function processOCR(image) {
            statusDiv.innerText = '🔄 Reading number...';
            const worker = await Tesseract.createWorker('eng');
            const { data: { text } } = await worker.recognize(image);
            await worker.terminate();
            ocrResult.value = text.trim();
            statusDiv.innerText = '✅ OCR completed';
        }

        sendBtn.addEventListener('click', async () => {
            const reading = manualInput.value || ocrResult.value;
            if (!reading) return alert('Please scan or enter a reading.');

            statusDiv.innerText = '⏳ Saving...';
            const res = await fetch("{{ route('meters.scan.process', $meter->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ reading }),
            });

            const data = await res.json();
            if (data.status === 'success') {
                statusDiv.innerHTML = `
                    <p class="text-green-700">✅ Reading saved successfully!</p>
                    <p>Consumption: ${data.data.consumption}</p>
                    <p>Amount: ${data.data.amount} AFN</p>
                `;
            } else {
                statusDiv.innerHTML = `<p class="text-red-600">❌ ${data.message}</p>`;
            }
        });
    </script>
</x-app-layout>
