@extends('layouts.app')

@section('title', 'Kelola Soal Quiz')
@section('subtitle', 'Manajemen soal untuk quiz: ' . $quiz->judul)

@push('styles')
<style>
    .math-fraction {
        display: inline-block;
        text-align: center;
        vertical-align: middle;
        margin: 0 0.2em;
    }
    
    .math-fraction::before {
        content: '';
        display: block;
        border-bottom: 1px solid currentColor;
        margin-bottom: 0.1em;
    }
    
    .math-sqrt {
        border-top: 1px solid currentColor;
        padding-top: 0.1em;
    }
    
    .math-sum, .math-integral {
        font-weight: bold;
    }
    
    sup, sub {
        font-size: 0.75em;
        line-height: 1;
    }
</style>
@endpush

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('guru.quiz.show', $quiz) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900">Kelola Soal Quiz</h2>
                </div>
                <div class="flex space-x-3">
                    <button onclick="openAddSoalModal()"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Soal
                    </button>
                    <a href="{{ route('guru.quiz.show', $quiz) }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Kembali ke Quiz
                    </a>
                </div>
            </div>
            <p class="text-gray-600 mt-1">Quiz: {{ $quiz->judul }} • {{ $quiz->materi->judul }} • {{ $quiz->kelas->nama }}
            </p>
        </div>

        <!-- Quiz Info -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Informasi Quiz</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600">{{ $soal->count() }}</div>
                        <div class="text-sm text-gray-500">Total Soal</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $quiz->jumlah_soal }}</div>
                        <div class="text-sm text-gray-500">Target Soal</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $quiz->durasi }}</div>
                        <div class="text-sm text-gray-500">Durasi (menit)</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-orange-600">{{ $quiz->passing_score }}%</div>
                        <div class="text-sm text-gray-500">Nilai Minimum</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Soal List -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Soal ({{ $soal->count() }})</h3>
            </div>
            <div class="p-6">
                @if ($soal->count() > 0)
                    <div class="space-y-4">
                        @foreach ($soal as $index => $s)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <span
                                                class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-3">
                                                Soal {{ $index + 1 }}
                                            </span>
                                            <span class="text-sm text-gray-500">Urutan: {{ $s->urutan }}</span>
                                            <span class="text-sm text-gray-500 ml-3">Bobot: {{ $s->bobot_nilai }}</span>
                                            <span
                                                class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if ($s->tipe_soal === 'pilihan_ganda') bg-blue-100 text-blue-800
                                                @else bg-green-100 text-green-800 @endif">
                                                {{ ucfirst(str_replace('_', ' ', $s->tipe_soal)) }}
                                            </span>
                                        </div>
                                        <h4 class="text-lg font-medium text-gray-900 mb-3">
                                            @if($s->pertanyaan_html)
                                                {!! $s->pertanyaan_html !!}
                                            @else
                                                {{ $s->pertanyaan }}
                                            @endif
                                        </h4>
                                        
                                        @if($s->gambar_soal)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $s->gambar_soal) }}" 
                                                     alt="Gambar soal" 
                                                     class="max-w-md rounded border">
                                            </div>
                                        @endif

                                        @if ($s->tipe_soal === 'pilihan_ganda')
                                            <div class="space-y-2 mb-3">
                                                @foreach (['a', 'b', 'c', 'd'] as $option)
                                                    <div class="flex items-start">
                                                        <span class="w-6 h-6 mr-3 text-sm text-gray-600 font-medium mt-1">{{ strtoupper($option) }}.</span>
                                                        <div class="flex-1">
                                                            <span class="text-gray-700 {{ $s->jawaban_benar === $option ? 'font-semibold text-green-600' : '' }}">
                                                                {{ $s->{'opsi_' . $option} }}
                                                                @if ($s->jawaban_benar === $option)
                                                                    <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Jawaban Benar</span>
                                                                @endif
                                                            </span>
                                                            @if($s->{'gambar_opsi_' . $option})
                                                                <div class="mt-2">
                                                                    <img src="{{ asset('storage/' . $s->{'gambar_opsi_' . $option}) }}" 
                                                                         alt="Gambar opsi {{ strtoupper($option) }}" 
                                                                         class="max-w-32 rounded border">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <span class="text-sm text-gray-600">Jawaban: <span
                                                        class="font-medium">{{ $s->jawaban_benar ?: 'Tidak ada jawaban standar' }}</span></span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex space-x-2 ml-4">
                                        <button onclick="openEditSoalModal({{ $s->id }})"
                                            class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                            Edit
                                        </button>
                                        <form
                                            action="{{ route('guru.quiz.destroy-soal', ['quiz' => $quiz, 'soal' => $s]) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 text-sm font-medium"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus soal ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada soal</h3>
                        <p class="mt-1 text-sm text-gray-500">Tambahkan soal untuk quiz ini.</p>
                        <div class="mt-6">
                            <button onclick="openAddSoalModal()"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Soal Pertama
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add Soal Modal -->
    <div id="addSoalModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tambah Soal Baru</h3>
                    <button onclick="closeAddSoalModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('guru.quiz.store-soal', $quiz) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="pertanyaan" class="block text-sm font-medium text-gray-700 mb-2">
                            Pertanyaan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="pertanyaan" id="pertanyaan" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                            placeholder="Tulis pertanyaan soal..."></textarea>
                        
                        <!-- Hidden field for HTML content -->
                        <input type="hidden" name="pertanyaan_html" id="pertanyaan_html">
                        
                        <!-- Math Editor Toolbar -->
                        <div class="mt-2 p-2 bg-gray-50 rounded-md border">
                            <p class="text-xs text-gray-600 mb-2">Editor Matematika:</p>
                            <div class="flex flex-wrap gap-1">
                                <button type="button" onclick="insertMath('\\frac{a}{b}')" class="px-2 py-1 text-xs bg-blue-100 hover:bg-blue-200 rounded">Pecahan</button>
                                <button type="button" onclick="insertMath('\\sqrt{x}')" class="px-2 py-1 text-xs bg-blue-100 hover:bg-blue-200 rounded">Akar</button>
                                <button type="button" onclick="insertMath('x^2')" class="px-2 py-1 text-xs bg-blue-100 hover:bg-blue-200 rounded">Pangkat</button>
                                <button type="button" onclick="insertMath('\\pi')" class="px-2 py-1 text-xs bg-blue-100 hover:bg-blue-200 rounded">π</button>
                                <button type="button" onclick="insertMath('\\theta')" class="px-2 py-1 text-xs bg-blue-100 hover:bg-blue-200 rounded">θ</button>
                                <button type="button" onclick="insertMath('\\alpha')" class="px-2 py-1 text-xs bg-blue-100 hover:bg-blue-200 rounded">α</button>
                                <button type="button" onclick="insertMath('\\beta')" class="px-2 py-1 text-xs bg-blue-100 hover:bg-blue-200 rounded">β</button>
                                <button type="button" onclick="insertMath('\\sum_{i=1}^{n}')" class="px-2 py-1 text-xs bg-blue-100 hover:bg-blue-200 rounded">∑</button>
                                <button type="button" onclick="insertMath('\\int_{a}^{b}')" class="px-2 py-1 text-xs bg-blue-100 hover:bg-blue-200 rounded">∫</button>
                            </div>
                        </div>
                    </div>

                    <!-- Gambar Soal -->
                    <div class="mb-4">
                        <label for="gambar_soal" class="block text-sm font-medium text-gray-700 mb-2">
                            Gambar Soal (Opsional)
                        </label>
                        <input type="file" name="gambar_soal" id="gambar_soal" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <p class="mt-1 text-sm text-gray-500">Upload gambar untuk soal (JPG, PNG, GIF, max 2MB)</p>
                        <img id="preview_gambar_soal" class="mt-2 max-w-xs rounded border hidden" alt="Preview gambar soal">
                    </div>

                    <div class="mb-4">
                        <label for="tipe_soal" class="block text-sm font-medium text-gray-700 mb-2">
                            Tipe Soal <span class="text-red-500">*</span>
                        </label>
                        <select name="tipe_soal" id="tipe_soal" required onchange="togglePilihanGanda()"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Pilih tipe soal</option>
                            <option value="pilihan_ganda">Pilihan Ganda</option>
                            <option value="essay">Essay</option>
                        </select>
                    </div>

                    <div id="pilihanGandaFields" class="hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="opsi_a" class="block text-sm font-medium text-gray-700 mb-2">
                                    Opsi A <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="opsi_a" id="opsi_a"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                    placeholder="Opsi A">
                                <input type="file" name="gambar_opsi_a" id="gambar_opsi_a" accept="image/*"
                                    class="w-full mt-2 px-2 py-1 border border-gray-300 rounded-md text-xs">
                                <img id="preview_gambar_opsi_a" class="mt-1 max-w-20 rounded border hidden" alt="Preview opsi A">
                            </div>
                            <div>
                                <label for="opsi_b" class="block text-sm font-medium text-gray-700 mb-2">
                                    Opsi B <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="opsi_b" id="opsi_b"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                    placeholder="Opsi B">
                                <input type="file" name="gambar_opsi_b" id="gambar_opsi_b" accept="image/*"
                                    class="w-full mt-2 px-2 py-1 border border-gray-300 rounded-md text-xs">
                                <img id="preview_gambar_opsi_b" class="mt-1 max-w-20 rounded border hidden" alt="Preview opsi B">
                            </div>
                            <div>
                                <label for="opsi_c" class="block text-sm font-medium text-gray-700 mb-2">
                                    Opsi C <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="opsi_c" id="opsi_c"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                    placeholder="Opsi C">
                                <input type="file" name="gambar_opsi_c" id="gambar_opsi_c" accept="image/*"
                                    class="w-full mt-2 px-2 py-1 border border-gray-300 rounded-md text-xs">
                                <img id="preview_gambar_opsi_c" class="mt-1 max-w-20 rounded border hidden" alt="Preview opsi C">
                            </div>
                            <div>
                                <label for="opsi_d" class="block text-sm font-medium text-gray-700 mb-2">
                                    Opsi D <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="opsi_d" id="opsi_d"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                    placeholder="Opsi D">
                                <input type="file" name="gambar_opsi_d" id="gambar_opsi_d" accept="image/*"
                                    class="w-full mt-2 px-2 py-1 border border-gray-300 rounded-md text-xs">
                                <img id="preview_gambar_opsi_d" class="mt-1 max-w-20 rounded border hidden" alt="Preview opsi D">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="jawaban_benar" class="block text-sm font-medium text-gray-700 mb-2">
                                Jawaban Benar <span class="text-red-500">*</span>
                            </label>
                            <select name="jawaban_benar" id="jawaban_benar" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Pilih jawaban benar</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="bobot_nilai" class="block text-sm font-medium text-gray-700 mb-2">
                                Bobot Nilai <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="bobot_nilai" id="bobot_nilai" min="1" max="10"
                                value="1" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                                Urutan <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="urutan" id="urutan" min="1"
                                value="{{ $soal->count() + 1 }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeAddSoalModal()"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Tambah Soal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <script>
        function openAddSoalModal() {
            document.getElementById('addSoalModal').classList.remove('hidden');
            setupImagePreviews();
        }

        function closeAddSoalModal() {
            document.getElementById('addSoalModal').classList.add('hidden');
        }

        function togglePilihanGanda() {
            const tipeSoal = document.getElementById('tipe_soal').value;
            const pilihanGandaFields = document.getElementById('pilihanGandaFields');
            
            if (tipeSoal === 'pilihan_ganda') {
                pilihanGandaFields.classList.remove('hidden');
                // Set required attributes
                document.getElementById('opsi_a').required = true;
                document.getElementById('opsi_b').required = true;
                document.getElementById('opsi_c').required = true;
                document.getElementById('opsi_d').required = true;
                document.getElementById('jawaban_benar').required = true;
            } else {
                pilihanGandaFields.classList.add('hidden');
                // Remove required attributes
                document.getElementById('opsi_a').required = false;
                document.getElementById('opsi_b').required = false;
                document.getElementById('opsi_c').required = false;
                document.getElementById('opsi_d').required = false;
                document.getElementById('jawaban_benar').required = false;
            }
        }

        // Math editor functions
        function insertMath(formula) {
            const textarea = document.getElementById('pertanyaan');
            const cursorPos = textarea.selectionStart;
            const textBefore = textarea.value.substring(0, cursorPos);
            const textAfter = textarea.value.substring(cursorPos);
            
            textarea.value = textBefore + formula + textAfter;
            textarea.focus();
            textarea.setSelectionRange(cursorPos + formula.length, cursorPos + formula.length);
            
            // Update hidden HTML field
            updateHTMLContent();
        }

        function updateHTMLContent() {
            const textarea = document.getElementById('pertanyaan');
            const htmlField = document.getElementById('pertanyaan_html');
            
            // Convert LaTeX to HTML (basic conversion)
            let htmlContent = textarea.value
                .replace(/\\frac\{([^}]+)\}\{([^}]+)\}/g, '<span class="math-fraction">$1/$2</span>')
                .replace(/\\sqrt\{([^}]+)\}/g, '<span class="math-sqrt">√$1</span>')
                .replace(/\^(\d+)/g, '<sup>$1</sup>')
                .replace(/\\pi/g, 'π')
                .replace(/\\theta/g, 'θ')
                .replace(/\\alpha/g, 'α')
                .replace(/\\beta/g, 'β')
                .replace(/\\sum_\{([^}]+)\}\^\{([^}]+)\}/g, '<span class="math-sum">∑<sub>$1</sub><sup>$2</sup></span>')
                .replace(/\\int_\{([^}]+)\}\^\{([^}]+)\}/g, '<span class="math-integral">∫<sub>$1</sub><sup>$2</sup></span>');
            
            htmlField.value = htmlContent;
        }

        // Image preview functions
        function setupImagePreview(inputId, previewId) {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            
            input.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.style.display = 'none';
                }
            });
        }

        // Setup image previews when modal opens
        function setupImagePreviews() {
            setupImagePreview('gambar_soal', 'preview_gambar_soal');
            setupImagePreview('gambar_opsi_a', 'preview_gambar_opsi_a');
            setupImagePreview('gambar_opsi_b', 'preview_gambar_opsi_b');
            setupImagePreview('gambar_opsi_c', 'preview_gambar_opsi_c');
            setupImagePreview('gambar_opsi_d', 'preview_gambar_opsi_d');
        }

        // Update HTML content when textarea changes
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('pertanyaan');
            if (textarea) {
                textarea.addEventListener('input', updateHTMLContent);
            }
        });

        // Close modal when clicking outside
        document.getElementById('addSoalModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAddSoalModal();
            }
        });
    </script>
@endsection
