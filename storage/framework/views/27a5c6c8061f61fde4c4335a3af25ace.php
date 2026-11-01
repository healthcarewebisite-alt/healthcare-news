<?php if (isset($component)) { $__componentOriginalfa710ee477a7171fb238cadd060c5959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa710ee477a7171fb238cadd060c5959 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\App::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> Kalkulator Kesehatan - BMI, Kalori & Usia Kehamilan | Healthcare.id <?php $__env->endSlot(); ?>
     <?php $__env->slot('description', null, []); ?> Hitung Indeks Massa Tubuh (BMI), kebutuhan kalori harian, dan usia kehamilan secara gratis dan akurat. <?php $__env->endSlot(); ?>

    <div class="max-w-4xl mx-auto px-4 md:px-6 py-8" x-data="healthCalculator()">
        <div class="text-center mb-8">
            <span class="badge-category">🧮 Fitur Unggulan</span>
            <h1 class="mt-3 text-2xl md:text-3xl font-extrabold text-inkdark">Kalkulator Kesehatan</h1>
            <p class="mt-2 text-slate-500 max-w-xl mx-auto">
                Hitung Indeks Massa Tubuh (BMI), kebutuhan kalori harian, dan estimasi usia kehamilan dengan cepat dan mudah.
            </p>
        </div>

        
        <div class="flex flex-wrap justify-center gap-2 mb-6">
            <button @click="tab = 'bmi'" :class="tab === 'bmi' ? 'bg-primary text-white' : 'bg-white text-slate-600 border border-slate-200'"
                    class="px-4 py-2 rounded-full text-sm font-semibold transition-colors">
                ⚖️ BMI
            </button>
            <button @click="tab = 'kalori'" :class="tab === 'kalori' ? 'bg-primary text-white' : 'bg-white text-slate-600 border border-slate-200'"
                    class="px-4 py-2 rounded-full text-sm font-semibold transition-colors">
                🔥 Kebutuhan Kalori
            </button>
            <button @click="tab = 'kehamilan'" :class="tab === 'kehamilan' ? 'bg-primary text-white' : 'bg-white text-slate-600 border border-slate-200'"
                    class="px-4 py-2 rounded-full text-sm font-semibold transition-colors">
                🤰 Usia Kehamilan
            </button>
        </div>

        
        <div x-show="tab === 'bmi'" x-cloak class="admin-card">
            <h2 class="font-bold text-inkdark mb-1">Kalkulator BMI (Indeks Massa Tubuh)</h2>
            <p class="text-sm text-slate-500 mb-5">Masukkan berat dan tinggi badan Anda untuk mengetahui kategori berat badan ideal.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="admin-label">Berat Badan (kg)</label>
                    <input type="number" x-model.number="bmi.weight" min="1" max="300" step="0.1" class="admin-input" placeholder="Mis: 65">
                </div>
                <div>
                    <label class="admin-label">Tinggi Badan (cm)</label>
                    <input type="number" x-model.number="bmi.height" min="50" max="250" step="0.1" class="admin-input" placeholder="Mis: 170">
                </div>
            </div>

            <template x-if="bmiResult">
                <div class="mt-5 rounded-lg p-5 text-center" :class="bmiCategoryColor">
                    <p class="text-sm font-medium opacity-80">BMI Anda</p>
                    <p class="text-4xl font-extrabold mt-1" x-text="bmiResult"></p>
                    <p class="text-sm font-semibold mt-2" x-text="bmiCategory"></p>
                </div>
            </template>

            <div class="mt-5 text-xs text-slate-400 flex flex-wrap gap-x-4 gap-y-1">
                <span>&lt; 18.5 Berat Badan Kurang</span>
                <span>18.5–24.9 Normal</span>
                <span>25–29.9 Berat Badan Berlebih</span>
                <span>&ge; 30 Obesitas</span>
            </div>
        </div>

        
        <div x-show="tab === 'kalori'" x-cloak class="admin-card">
            <h2 class="font-bold text-inkdark mb-1">Kalkulator Kebutuhan Kalori Harian</h2>
            <p class="text-sm text-slate-500 mb-5">Estimasi kebutuhan kalori harian berdasarkan rumus Mifflin-St Jeor.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="admin-label">Jenis Kelamin</label>
                    <select x-model="kalori.gender" class="admin-input">
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="admin-label">Usia (tahun)</label>
                    <input type="number" x-model.number="kalori.age" min="10" max="100" class="admin-input" placeholder="Mis: 30">
                </div>
                <div>
                    <label class="admin-label">Berat Badan (kg)</label>
                    <input type="number" x-model.number="kalori.weight" min="1" max="300" step="0.1" class="admin-input" placeholder="Mis: 65">
                </div>
                <div>
                    <label class="admin-label">Tinggi Badan (cm)</label>
                    <input type="number" x-model.number="kalori.height" min="50" max="250" step="0.1" class="admin-input" placeholder="Mis: 170">
                </div>
                <div class="sm:col-span-2">
                    <label class="admin-label">Tingkat Aktivitas</label>
                    <select x-model.number="kalori.activity" class="admin-input">
                        <option value="1.2">Jarang berolahraga (aktivitas ringan)</option>
                        <option value="1.375">Olahraga ringan 1–3 hari/minggu</option>
                        <option value="1.55">Olahraga sedang 3–5 hari/minggu</option>
                        <option value="1.725">Olahraga berat 6–7 hari/minggu</option>
                        <option value="1.9">Aktivitas sangat berat / atlet</option>
                    </select>
                </div>
            </div>

            <template x-if="kaloriResult">
                <div class="mt-5 rounded-lg p-5 text-center bg-secondary-50">
                    <p class="text-sm font-medium text-secondary-700 opacity-80">Kebutuhan Kalori Harian Anda</p>
                    <p class="text-4xl font-extrabold mt-1 text-secondary-700" x-text="kaloriResult + ' kkal'"></p>
                    <p class="text-sm text-secondary-600 mt-2">untuk mempertahankan berat badan saat ini</p>
                </div>
            </template>
        </div>

        
        <div x-show="tab === 'kehamilan'" x-cloak class="admin-card">
            <h2 class="font-bold text-inkdark mb-1">Kalkulator Usia Kehamilan &amp; HPL</h2>
            <p class="text-sm text-slate-500 mb-5">Masukkan Hari Pertama Haid Terakhir (HPHT) untuk mengetahui usia kehamilan dan estimasi Hari Perkiraan Lahir (HPL).</p>

            <label class="admin-label">Hari Pertama Haid Terakhir (HPHT)</label>
            <input type="date" x-model="kehamilan.hpht" class="admin-input max-w-xs">

            <template x-if="kehamilanResult">
                <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-lg p-5 text-center bg-pink-50">
                        <p class="text-sm font-medium text-pink-700 opacity-80">Usia Kehamilan</p>
                        <p class="text-3xl font-extrabold mt-1 text-pink-700" x-text="kehamilanResult.weeks + ' minggu ' + kehamilanResult.days + ' hari'"></p>
                    </div>
                    <div class="rounded-lg p-5 text-center bg-primary-50">
                        <p class="text-sm font-medium text-primary-700 opacity-80">Estimasi Hari Perkiraan Lahir (HPL)</p>
                        <p class="text-xl font-extrabold mt-1 text-primary-700" x-text="kehamilanResult.dueDate"></p>
                    </div>
                </div>
            </template>

            <p class="mt-4 text-xs text-slate-400">
                *Perhitungan berdasarkan rumus Naegele (siklus haid 28 hari). Hasil bersifat estimasi, konsultasikan dengan dokter kandungan untuk kepastian.
            </p>
        </div>

        <p class="mt-6 text-center text-xs text-slate-400">
            Hasil kalkulator bersifat estimasi umum dan tidak menggantikan diagnosis atau saran medis profesional.
            Konsultasikan dengan tenaga kesehatan untuk evaluasi lebih lanjut.
        </p>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        function healthCalculator() {
            return {
                tab: 'bmi',
                bmi: { weight: null, height: null },
                kalori: { gender: 'male', age: null, weight: null, height: null, activity: 1.2 },
                kehamilan: { hpht: '' },

                get bmiResult() {
                    const w = this.bmi.weight, h = this.bmi.height;
                    if (!w || !h || w <= 0 || h <= 0) return null;
                    const meters = h / 100;
                    return (w / (meters * meters)).toFixed(1);
                },
                get bmiCategory() {
                    const val = parseFloat(this.bmiResult);
                    if (!val) return '';
                    if (val < 18.5) return 'Berat Badan Kurang';
                    if (val < 25) return 'Berat Badan Normal';
                    if (val < 30) return 'Berat Badan Berlebih';
                    return 'Obesitas';
                },
                get bmiCategoryColor() {
                    const val = parseFloat(this.bmiResult);
                    if (!val) return '';
                    if (val < 18.5) return 'bg-amber-50 text-amber-700';
                    if (val < 25) return 'bg-secondary-50 text-secondary-700';
                    if (val < 30) return 'bg-amber-50 text-amber-700';
                    return 'bg-breaking-50 text-breaking-700';
                },

                get kaloriResult() {
                    const { gender, age, weight, height, activity } = this.kalori;
                    if (!age || !weight || !height || age <= 0 || weight <= 0 || height <= 0) return null;
                    // Rumus Mifflin-St Jeor
                    let bmr = (10 * weight) + (6.25 * height) - (5 * age);
                    bmr += gender === 'male' ? 5 : -161;
                    return Math.round(bmr * activity);
                },

                get kehamilanResult() {
                    if (!this.kehamilan.hpht) return null;
                    const hpht = new Date(this.kehamilan.hpht);
                    if (isNaN(hpht.getTime())) return null;

                    const today = new Date();
                    const diffMs = today - hpht;
                    if (diffMs < 0) return null;

                    const totalDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
                    const weeks = Math.floor(totalDays / 7);
                    const days = totalDays % 7;

                    // Rumus Naegele: HPHT + 280 hari (40 minggu)
                    const dueDate = new Date(hpht);
                    dueDate.setDate(dueDate.getDate() + 280);

                    const bulanIndo = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                    const formattedDueDate = `${dueDate.getDate()} ${bulanIndo[dueDate.getMonth()]} ${dueDate.getFullYear()}`;

                    return { weeks, days, dueDate: formattedDueDate };
                },
            };
        }
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa710ee477a7171fb238cadd060c5959)): ?>
<?php $attributes = $__attributesOriginalfa710ee477a7171fb238cadd060c5959; ?>
<?php unset($__attributesOriginalfa710ee477a7171fb238cadd060c5959); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa710ee477a7171fb238cadd060c5959)): ?>
<?php $component = $__componentOriginalfa710ee477a7171fb238cadd060c5959; ?>
<?php unset($__componentOriginalfa710ee477a7171fb238cadd060c5959); ?>
<?php endif; ?>
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/pages/calculator.blade.php ENDPATH**/ ?>