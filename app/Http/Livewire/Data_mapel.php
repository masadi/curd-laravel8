<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mapel;
class Data_mapel extends Component
{
    public $mapel, $nama, $mapel_id;
    public $isModal = 0;
    public function render()
    {
        $this->mapel = Mapel::orderBy('created_at', 'DESC')->get();
        return view('livewire.mapel');
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
        $this->mapel_id = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|unique:mapel,nama,' . $this->mapel_id,
        ]);

        Mapel::updateOrCreate(['id' => $this->mapel_id], [
            'nama' => $this->nama,
        ]);

        session()->flash('message', $this->mapel_id ? $this->nama . ' Diperbaharui': $this->nama . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    public function edit($id)
    {
        $mapel = Mapel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        $this->mapel_id = $id;
        $this->nama = $mapel->nama;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $mapel = Mapel::find($id); //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        $mapel->delete(); //LALU HAPUS DATA
        session()->flash('message', $mapel->nama . ' Dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
    }
}
