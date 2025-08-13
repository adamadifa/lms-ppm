@extends('layouts.app')

@section('title', 'Mengerjakan Quiz')
@section('subtitle', $quiz->judul)

@section('content')
    <div class="p-4 sm:p-6">
        <!-- Header Section -->
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center">
                <a href="{{ route('siswa.quiz.show', $quiz) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900">{{ $quiz->judul }}</h2>
            </div>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Durasi: {{ $quiz->durasi }} menit • {{ $soal->count() }} soal
            </p>
        </div>

        <!-- Quiz Form -->
        <form action="{{ route('siswa.quiz.submit', $quiz) }}" method="POST" id="quizForm">
            @csrf

            <div class="space-y-6">
                @foreach ($soal as $index => $question)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                            <h4 class="text-base sm:text-lg font-medium text-gray-900">
                                Soal {{ $index + 1 }} dari {{ $soal->count() }}
                            </h4>
                        </div>

                        <div class="p-4 sm:p-6">
                            <!-- Question Content -->
                            <div class="mb-4 sm:mb-6">
                                <div class="prose max-w-none text-sm sm:text-base">
                                    {!! nl2br(e($question->pertanyaan)) !!}
                                </div>

                                @if ($question->gambar_soal)
                                    <div class="mt-3 sm:mt-4">
                                        <img src="{{ asset('storage/' . $question->gambar_soal) }}" alt="Gambar soal"
                                            class="max-w-full h-auto rounded-lg border">
                                    </div>
                                @endif
                            </div>

                            <!-- Answer Options -->
                            <div class="space-y-3">
                                @if ($question->tipe_soal === 'pilihan_ganda')
                                    @php
                                        $options = ['A', 'B', 'C', 'D'];
                                    @endphp

                                    @foreach ($options as $option)
                                        @php
                                            $optionKey = 'opsi_' . strtolower($option);
                                            $optionValue = $question->$optionKey;
                                        @endphp

                                        @if ($optionValue)
                                            <label
                                                class="flex items-start p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                                <input type="radio" name="jawaban[{{ $question->id }}]"
                                                    value="{{ $optionValue }}"
                                                    class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 mt-1">
                                                <div class="ml-3 flex-1">
                                                    <span class="text-gray-700 text-sm sm:text-base">
                                                        {{ $option }}. {{ $optionValue }}
                                                    </span>

                                                    @php
                                                        $imageKey = 'gambar_opsi_' . strtolower($option);
                                                    @endphp
                                                    @if ($question->$imageKey)
                                                        <div class="mt-2 flex justify-center sm:justify-start">
                                                            <img src="{{ asset('storage/' . $question->$imageKey) }}"
                                                                alt="Gambar opsi {{ $option }}"
                                                                class="max-w-full h-auto max-h-32 rounded border">
                                                        </div>
                                                    @endif
                                                </div>
                                            </label>
                                        @endif
                                    @endforeach
                                @elseif($question->tipe_soal === 'essay')
                                    <textarea name="jawaban[{{ $question->id }}]" rows="4"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Tulis jawaban Anda di sini..."></textarea>
                                @else
                                    <input type="text" name="jawaban[{{ $question->id }}]"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Tulis jawaban Anda di sini...">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Submit Button -->
            <div class="mt-6 sm:mt-8 bg-white rounded-lg shadow p-4 sm:p-6">
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-4">Pastikan semua soal sudah dijawab sebelum mengumpulkan quiz</p>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-md text-base sm:text-lg font-medium transition-colors">
                        Kumpulkan Quiz
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Simple form validation
        document.getElementById('quizForm').addEventListener('submit', function(e) {
            const radioGroups = document.querySelectorAll('input[type="radio"]');
            const textInputs = document.querySelectorAll('input[type="text"], textarea');

            let hasAnswers = true;

            // Check radio button groups (pilihan ganda)
            const questionIds = new Set();
            radioGroups.forEach(radio => {
                questionIds.add(radio.name);
            });

            questionIds.forEach(questionName => {
                const checkedRadio = document.querySelector(`input[name="${questionName}"]:checked`);
                if (!checkedRadio) {
                    hasAnswers = false;
                }
            });

            // Check text inputs and textareas
            textInputs.forEach(input => {
                if (!input.value.trim()) {
                    hasAnswers = false;
                }
            });

            if (!hasAnswers) {
                e.preventDefault();
                alert('Silakan jawab semua soal terlebih dahulu sebelum mengumpulkan quiz!');
                return false;
            }

            // Confirm submission
            if (!confirm(
                    'Apakah Anda yakin ingin mengumpulkan quiz? Setelah dikumpulkan, jawaban tidak dapat diubah.'
                    )) {
                e.preventDefault();
                return false;
            }
        });
    </script>
@endsection
