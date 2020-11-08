<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Guru;
use App\Models\Pembelajaran;
class Data_guru extends Component
{
    public $guru, $nama, $nuptk, $guru_id, $pembelajaran;
    public $isModal = 0;
    public $isModalPembelajaran = 0;
    public function render()
    {
        $this->guru = Guru::orderBy('created_at', 'DESC')->get();
        return view('livewire.guru');
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
    public function closeModalPembelajaran()
    {
        $this->isModalPembelajaran = false;
    }

    public function openModalPembelajaran()
    {
        $this->isModalPembelajaran = true;
    }

    public function resetFields()
    {
        $this->nama = '';
        $this->nuptk = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|unique:kelas,nama,' . $this->guru_id,
            'nuptk' => 'required'
        ]);

        Guru::updateOrCreate(['id' => $this->guru_id], [
            'nama' => $this->nama,
            'nuptk' => $this->nuptk,
        ]);

        session()->flash('message', $this->guru_id ? $this->nama . ' Diperbaharui': $this->nama . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    public function edit($id)
    {
        $guru = Guru::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        $this->guru_id = $id;
        $this->nama = $guru->nama;
        $this->nuptk = $guru->nuptk;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $guru = Guru::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        $guru->delete(); //LALU HAPUS DATA
        session()->flash('message', $guru->nama . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
    }
    public function mapel_diampu($id){
        $this->pembelajaran = Pembelajaran::where('guru_id', $id)->get(); //BUAT QUERY UTK PENGAMBILAN DATA
        
        $this->openModalPembelajaran(); //LALU BUKA MODAL
    }
    public function delete_pembelajaran($id){
        $pembelajaran = Pembelajaran::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        $pembelajaran->delete(); //LALU HAPUS DATA
        session()->flash('message', $pembelajaran->nama . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
    }
}
