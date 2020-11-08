<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jurusan;
class Data_jurusan extends Component
{
    public $jurusan, $nama, $jurusan_id;
    public $isModal = 0;
    public function render()
    {
        $this->jurusan = Jurusan::orderBy('created_at', 'DESC')->get();
        return view('livewire.jurusan');
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
        $this->jurusan_id = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|unique:jurusan,nama,' . $this->jurusan_id,
        ]);

        Jurusan::updateOrCreate(['id' => $this->jurusan_id], [
            'nama' => $this->nama,
        ]);

        session()->flash('message', $this->jurusan_id ? $this->nama . ' Diperbaharui': $this->nama . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    public function edit($id)
    {
        $jurusan = Jurusan::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        $this->jurusan_id = $id;
        $this->nama = $jurusan->nama;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $jurusan = Jurusan::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        $jurusan->delete(); //LALU HAPUS DATA
        session()->flash('message', $jurusan->nama . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
    }
}
