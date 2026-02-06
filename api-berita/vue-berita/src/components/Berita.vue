<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import api from "../plugins/axios";

const beritas = ref([]);
const judul = ref("");
const isi = ref("");
const isEdit = ref(false);
const editId = ref(null);

const loadData = async () => {
    const res = await axios.get("http://127.0.0.1:8000/api/berita");
    beritas.value = res.data;
};

const simpan = async () => {
    if (isEdit.value) {
        await api.put(`/berita/${editId.value}`, {
            judul: judul.value,
            isi: isi.value,
        });
    } else {
        await api.post("/berita", {
            judul: judul.value,
            isi: isi.value,
        });
    }

    judul.value = "";
    isi.value = "";
    isEdit.value = false;
    editId.value = null;
    loadData();
};

const edit = (b) => {
    judul.value = b.judul;
    isi.value = b.isi;
    isEdit.value = true;
    editId.value = b.id;
};

const hapus = async (id) => {
    if (confirm("Yakin hapus data?")) {
        await api.delete(`/berita/${id}`);
        loadData();
    }
};


onMounted(loadData);
</script>

<template>
    <h2>Manajemen Berita</h2>

    <input v-model="judul" placeholder="Judul" />
    <textarea v-model="isi" placeholder="Isi"></textarea>
    <button @click="simpan">Simpan</button>

    <ul>
        <li v-for="b in beritas" :key="b.id">
            <b>{{ b.judul }}</b
            ><br />
            {{ b.isi }}
            <br />
            <button @click="edit(b)">Edit</button>
            <button @click="hapus(b.id)">Hapus</button>
        </li>
    </ul>
</template>
