<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/', [App\Http\Controllers\Front\LandingController::class, 'index'])->name('f.index');

Route::prefix('a')->middleware(['auth','admin'])->group(function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('a.home');

    Route::get('/data_produk', [App\Http\Controllers\Admin2\ProdukController::class, 'dataProduk'])->name('a.data.produk');
    Route::get('/tambah_produk', [App\Http\Controllers\Admin2\ProdukController::class, 'tambahProduk'])->name('a.tambah.produk');
    Route::post('/simpan_produk', [App\Http\Controllers\Admin2\ProdukController::class, 'simpanProduk'])->name('a.simpan.produk');
    Route::get('/edit_produk/{id}', [App\Http\Controllers\Admin2\ProdukController::class, 'editProduk'])->name('a.edit.produk');
    Route::post('/update_produk', [App\Http\Controllers\Admin2\ProdukController::class, 'updateProduk'])->name('a.update.produk');
    Route::get('/hapus_produk/{id}', [App\Http\Controllers\Admin2\ProdukController::class, 'hapusProduk'])->name('a.hapus.produk');

    Route::get('/orderan', [App\Http\Controllers\Admin2\OrderanController::class, 'index'])->name('a.order');
    Route::get('/histori-orderan', [App\Http\Controllers\Admin2\OrderanController::class, 'histori'])->name('a.histori.order');
    Route::post('/update_status_orderan', [App\Http\Controllers\Admin2\OrderanController::class, 'updateStatusOrderan'])->name('a.update.status.order');
    Route::post('/update_status_pengantar', [App\Http\Controllers\Admin2\OrderanController::class, 'updateStatusPengantar'])->name('a.update.status.pengantar');
    Route::get('/laporan', [App\Http\Controllers\Admin2\LaporanController::class, 'index'])->name('a.laporan');
    Route::get('/laporan/{month}', [App\Http\Controllers\Admin2\LaporanController::class, 'showMonth'])->name('a.laporan.month');
    Route::get('/laporan/year/{year}', [App\Http\Controllers\Admin2\LaporanController::class, 'showYear'])->name('a.laporan-tahun-details');



    // Route::get('/year', [App\Http\Controllers\Admin\TahunController::class, 'index'])->name('a.year');
    // Route::get('/year/add', [App\Http\Controllers\Admin\TahunController::class, 'addYear'])->name('a.year.add');
    // Route::post('/year/save', [App\Http\Controllers\Admin\TahunController::class, 'saveYear'])->name('a.year.save');
    // Route::post('/year/save/change', [App\Http\Controllers\Admin\TahunController::class, 'saveChangeYear'])->name('a.year.save.change');
    // Route::get('/year/list', [App\Http\Controllers\Admin\TahunController::class, 'listYear'])->name('a.year.list');

    // Route::get('/lecturer/add', [App\Http\Controllers\Admin\DosenController::class, 'addLecturer'])->name('a.lecturer.add');
    // Route::post('/lecturer/save', [App\Http\Controllers\Admin\DosenController::class, 'saveLecturer'])->name('a.lecturer.save');
    // Route::get('/lecturer', [App\Http\Controllers\Admin\DosenController::class, 'index'])->name('a.lecturer');
    // Route::get('/lecturer/list', [App\Http\Controllers\Admin\DosenController::class, 'listLecturer'])->name('a.lecturer.list');

    // Route::get('/class/add', [App\Http\Controllers\Admin\KelasController::class, 'addClass'])->name('a.class.add');
    // Route::post('/class/save', [App\Http\Controllers\Admin\KelasController::class, 'saveClass'])->name('a.class.save');
    // Route::post('/class/save/change', [App\Http\Controllers\Admin\KelasController::class, 'saveChangeClass'])->name('a.class.save.change');
    // Route::get('/class', [App\Http\Controllers\Admin\KelasController::class, 'index'])->name('a.class');
    // Route::get('/class/list', [App\Http\Controllers\Admin\KelasController::class, 'listClass'])->name('a.class.list');

    // Route::get('/major/add', [App\Http\Controllers\Admin\JurusanController::class, 'addMajor'])->name('a.major.add');
    // Route::post('/major/save', [App\Http\Controllers\Admin\JurusanController::class, 'saveMajor'])->name('a.major.save');
    // Route::post('/major/save/change', [App\Http\Controllers\Admin\JurusanController::class, 'saveChangeMajor'])->name('a.major.save.change');
    // Route::get('/major', [App\Http\Controllers\Admin\JurusanController::class, 'index'])->name('a.major');
    // Route::get('/major/list', [App\Http\Controllers\Admin\JurusanController::class, 'listMajor'])->name('a.major.list');

    // Route::get('/student/add', [App\Http\Controllers\Admin\MahasiswaController::class, 'addStudent'])->name('a.student.add');
    // Route::post('/student/save', [App\Http\Controllers\Admin\MahasiswaController::class, 'saveStudent'])->name('a.student.save');
    // Route::get('/students', [App\Http\Controllers\Admin\MahasiswaController::class, 'index'])->name('a.student');
    // Route::get('/student/{student_id}/detail', [App\Http\Controllers\Admin\MahasiswaController::class, 'detailStudents'])->name('a.students.detail');
    // Route::put('/student/save/change', [App\Http\Controllers\Admin\MahasiswaController::class, 'saveChangeStudent'])->name('a.students.save.change');
    // Route::get('/student/list', [App\Http\Controllers\Admin\MahasiswaController::class, 'listStudent'])->name('a.student.list');

    // Route::get('/student/reset/{user_id}/user', [App\Http\Controllers\Admin\MahasiswaController::class, 'resetPasswordUser'])->name('a.reset.password');
});

Route::prefix('p')->middleware(['auth','dosen'])->group(function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('d.home');

    Route::get('/pengantaran', [App\Http\Controllers\Pengantar\PengantaranController::class, 'index'])->name('d.pengantar');
    Route::get('/histori-pengantaran', [App\Http\Controllers\Pengantar\PengantaranController::class, 'histori'])->name('p.histori.pengantar');
    Route::post('/update-status-pengantar', [App\Http\Controllers\Admin2\OrderanController::class, 'updateStatusPesananKurir'])->name('p.update.status.pengantar');
    Route::post('/save/bukti-bayar', [App\Http\Controllers\Pengantar\PengantaranController::class, 'simpanBukti'])->name('p.bukti.simpan');

    // Route::get('/class', [App\Http\Controllers\Dosen\KelasDosenController::class, 'index'])->name('d.class');
    // Route::get('/class/list', [App\Http\Controllers\Dosen\KelasDosenController::class, 'listClass'])->name('d.class.list');
    // Route::get('/class/{class_id}/students', [App\Http\Controllers\Dosen\KelasDosenController::class, 'students'])->name('d.students');
    // Route::get('/class/{class_id}/students/list', [App\Http\Controllers\Dosen\KelasDosenController::class, 'listStudents'])->name('d.students.list');
    // Route::get('/class/out/{relation_id}/students', [App\Http\Controllers\Dosen\KelasDosenController::class, 'outClass'])->name('d.students.out.class');

    // Route::get('/class/students/{student_id}/detail', [App\Http\Controllers\Dosen\DetailDataController::class, 'detailStudents'])->name('d.students.detail');

    // Route::get('/task/add', [App\Http\Controllers\Dosen\TugasDosenController::class, 'addTask'])->name('d.task.add');
    // Route::post('/task/save', [App\Http\Controllers\Dosen\TugasDosenController::class, 'saveTask'])->name('a.task.save');
    // Route::get('/task/{task_id}/edit', [App\Http\Controllers\Dosen\TugasDosenController::class, 'editTask'])->name('d.task.edit');
    // Route::put('/task/save/change', [App\Http\Controllers\Dosen\TugasDosenController::class, 'saveChangeTask'])->name('a.task.save.change');

    // Route::get('/task/all', [App\Http\Controllers\Dosen\TugasDosenController::class, 'index'])->name('d.task');
    // Route::get('/task/list', [App\Http\Controllers\Dosen\TugasDosenController::class, 'listTask'])->name('d.task.list');
    // Route::get('/task/status/{task_id}/{status_kode}', [App\Http\Controllers\Dosen\TugasDosenController::class, 'statusTask'])->name('d.task.status');

    // Route::get('/task/by/class', [App\Http\Controllers\Dosen\TugasDosenController::class, 'taskByClass'])->name('d.task.by.class');
    // Route::get('/task/list/by/class', [App\Http\Controllers\Dosen\TugasDosenController::class, 'listTaskByClass'])->name('d.task.list.by.class');
    // Route::get('/task/see/{class_id}/view', [App\Http\Controllers\Dosen\TugasDosenController::class, 'taskRespon'])->name('d.task.respon');
    // Route::get('/task/see/{class_id}/list', [App\Http\Controllers\Dosen\TugasDosenController::class, 'listResponClass'])->name('d.task.list.respon');

    // Route::get('/task/{task_id}/response', [App\Http\Controllers\Dosen\ResponTugasController::class, 'responseTask'])->name('d.response');
    // Route::get('/task/{task_id}/list', [App\Http\Controllers\Dosen\ResponTugasController::class, 'listResponseTask'])->name('d.response.list');
    // Route::get('/task/delete/{result_id}/response', [App\Http\Controllers\Dosen\ResponTugasController::class, 'delResponseTask'])->name('d.response.delete');

    // Route::post('/task/feedback', [App\Http\Controllers\Dosen\ResponTugasController::class, 'feedBack'])->name('d.feedback');

    // Route::get('/materials/add', [App\Http\Controllers\Dosen\MateriDosenController::class, 'materialAdd'])->name('d.material.add');
    // Route::post('/material/save', [App\Http\Controllers\Dosen\MateriDosenController::class, 'saveMaterial'])->name('d.material.save');
    // Route::get('/material/{material_id}/edit', [App\Http\Controllers\Dosen\MateriDosenController::class, 'editMaterial'])->name('d.material.edit');
    // Route::put('/material/save/change', [App\Http\Controllers\Dosen\MateriDosenController::class, 'saveChangeMaterial'])->name('d.material.save.change');
    // Route::get('/material/by/class', [App\Http\Controllers\Dosen\MateriDosenController::class, 'materialByClass'])->name('d.material.by.class');
    // Route::get('/material/list/by/class', [App\Http\Controllers\Dosen\MateriDosenController::class, 'listMaterialByClass'])->name('d.material.list.by.class');
    // Route::get('/materials/{class_id}/view', [App\Http\Controllers\Dosen\MateriDosenController::class, 'viewMaterials'])->name('d.material.view');
    // Route::get('/materials/{class_id}/list', [App\Http\Controllers\Dosen\MateriDosenController::class, 'listMaterials'])->name('d.material.list');
    // Route::get('/material/{material_id}/delete', [App\Http\Controllers\Dosen\MateriDosenController::class, 'delMaterial'])->name('d.material.delete');

    // Route::get('/change/password', [App\Http\Controllers\Mahasiswa\EditController::class, 'changePassword'])->name('d.change.password');
    // Route::post('/change/password/proses', [App\Http\Controllers\Mahasiswa\EditController::class, 'changePasswordProses'])->name('d.change.password.proses');
});

Route::prefix('m')->middleware(['auth','mhs'])->group(function(){

    // Route::get('/my_profile', [App\Http\Controllers\Mahasiswa\ProfileController::class, 'myProfile'])->name('m.profile');
    // Route::put('/my_profile/save', [App\Http\Controllers\Mahasiswa\ProfileController::class, 'saveMyProfile'])->name('m.profile.save');

    // Route::middleware('checkProfile')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('m.home');
        Route::get('/cari', [App\Http\Controllers\HomeController::class, 'cari'])->name('m.cari');
        Route::get('/detail/{id}', [App\Http\Controllers\Masyarakat\ProdukController::class, 'detailProduk'])->name('m.detail');
        Route::get('/pesananku', [App\Http\Controllers\Masyarakat\PesananController::class, 'index'])->name('m.pesanan.index');
        Route::post('/save/pesanan', [App\Http\Controllers\Masyarakat\PesananController::class, 'simpanPesanan'])->name('m.pesanan.simpan');
        Route::post('/save/bukti_bayar', [App\Http\Controllers\Masyarakat\PesananController::class, 'simpanBukti'])->name('m.bukti.simpan');
    //     Route::get('/class/select', [App\Http\Controllers\Mahasiswa\KelasMahasiswaController::class, 'selectClass'])->name('m.class.select');
    //     Route::post('/class/select/save', [App\Http\Controllers\Mahasiswa\KelasMahasiswaController::class, 'saveClass'])->name('m.class.save');

    //     Route::get('/my_class', [App\Http\Controllers\Mahasiswa\KelasMahasiswaController::class, 'index'])->name('m.class');
    //     Route::get('/my_class/list', [App\Http\Controllers\Mahasiswa\KelasMahasiswaController::class, 'listMyClass'])->name('m.class.list');

    //     Route::get('/my_task', [App\Http\Controllers\Mahasiswa\TugasMahasiswaController::class, 'index'])->name('m.task');
    //     Route::get('/my_task/{class_id}/view', [App\Http\Controllers\Mahasiswa\TugasMahasiswaController::class, 'index2'])->name('m.task.2');
    //     Route::get('/my_task/{class_id}/class', [App\Http\Controllers\Mahasiswa\TugasMahasiswaController::class, 'listMyTaskClass'])->name('m.task.class.list');
    //     Route::get('/my_task/list', [App\Http\Controllers\Mahasiswa\TugasMahasiswaController::class, 'listMyTask'])->name('m.task.list');

    //     Route::get('/my_task/sent', [App\Http\Controllers\Mahasiswa\TugasMahasiswaController::class, 'taskSent'])->name('m.task.sent');
    //     Route::get('/my_task/sent/{class_id}/view', [App\Http\Controllers\Mahasiswa\TugasMahasiswaController::class, 'taskSentAtClass'])->name('m.task.sent.view');
    //     Route::get('/my_task/sent/{class_id}/class', [App\Http\Controllers\Mahasiswa\TugasMahasiswaController::class, 'listMyTaskSentClass'])->name('m.task.sent.class.list');
    //     Route::get('/my_task/sent/list', [App\Http\Controllers\Mahasiswa\TugasMahasiswaController::class, 'listMyTaskSent'])->name('m.task.sent.list');

    //     Route::get('/my_task/{task_id}/send', [App\Http\Controllers\Mahasiswa\HasilTugasMahasiswaController::class, 'index'])->name('m.task.send');
    //     Route::post('/my_task/send/save', [App\Http\Controllers\Mahasiswa\HasilTugasMahasiswaController::class, 'sendTaskSave'])->name('m.task.send.save');

    //     Route::get('/materials', [App\Http\Controllers\Mahasiswa\MateriController::class, 'materialByClass'])->name('m.material.by.class');
    //     Route::get('/materials/list', [App\Http\Controllers\Mahasiswa\MateriController::class, 'listMaterialByClass'])->name('m.material.list.by.class');
    //     Route::get('/material/{material_id}/detail', [App\Http\Controllers\Mahasiswa\MateriController::class, 'detailMaterial'])->name('m.material.detail');
    //     Route::get('/materials/{class_id}/view', [App\Http\Controllers\Mahasiswa\MateriController::class, 'viewMaterials'])->name('m.material.view');
    //     Route::get('/materials/{class_id}/list', [App\Http\Controllers\Mahasiswa\MateriController::class, 'listMaterials'])->name('m.material.list');

    //     Route::post('/my_task/edit', [App\Http\Controllers\Mahasiswa\EditController::class, 'editTask'])->name('m.task.edit');
    //     Route::get('/change/password', [App\Http\Controllers\Mahasiswa\EditController::class, 'changePassword'])->name('m.change.password');
    //     Route::post('/change/password/proses', [App\Http\Controllers\Mahasiswa\EditController::class, 'changePasswordProses'])->name('m.change.password.proses');
    // });

});
