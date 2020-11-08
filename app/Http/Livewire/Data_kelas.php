<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kelas;
class Data_kelas extends Component
{
    public $kelas, $nama, $tingkat, $kelas_id;
    public $isModal = 0;
    public function render()
    {
        $this->kelas = Kelas::orderBy('created_at', 'DESC')->get();
        return view('livewire.kelas');
    }
    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function resetFields()
    {
        $this->nama = '';
        $this->kelas_id = '';
        $this->tingkat = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|unique:kelas,nama,' . $this->kelas_id,
            'tingkat' => 'required'
        ]);

        Kelas::updateOrCreate(['id' => $this->kelas_id], [
            'nama' => $this->nama,
            'tingkat' => $this->tingkat,
        ]);

        session()->flash('message', $this->kelas_id ? $this->nama . ' Diperbaharui': $this->nama . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    public function edit($id)
    {
        $kelas = Kelas::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        $this->kelas_id = $id;
        $this->nama = $kelas->nama;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $kelas = Kelas::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        $kelas->delete(); //LALU HAPUS DATA
        session()->flash('message', $kelas->nama . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
    }
}
