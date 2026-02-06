<script setup>
import { ref } from "vue";
import api from "../plugins/axios";
import { useRouter } from "vue-router";

const router = useRouter();
const judul = ref("");
const isi = ref("");

const simpan = async () => {
    await api.post("/berita", {
        judul: judul.value,
        isi: isi.value,
    });

    router.push("/list-berita");
};

const kembali = () => {
    router.push("/list-berita");
};

</script>

<template>
    <div class="container">
        <div class="form-card">
            <h1 class="title">Tambah Berita</h1>
            <p class="subtitle">Masukkan informasi berita baru</p>

            <div class="form-group">
                <label>Judul Berita</label>
                <input
                    v-model="judul"
                    type="text"
                    placeholder="Masukkan judul berita"
                />
            </div>

            <div class="form-group">
                <label>Isi Berita</label>
                <textarea
                    v-model="isi"
                    rows="6"
                    placeholder="Tulis isi berita di sini"
                ></textarea>
            </div>

            <div class="actions">
                <button class="btn btn-secondary" @click="kembali">
                    Batal
                </button>
                <button class="btn btn-primary" @click="simpan">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    min-height: 100vh;
    background: linear-gradient(180deg, #f8fafc, #eef2ff);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: "Segoe UI", system-ui, sans-serif;
}

/* Card */
.form-card {
    background: white;
    width: 100%;
    max-width: 520px;
    padding: 32px;
    border-radius: 20px;
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.1);
}

/* Title */
.title {
    margin: 0;
    font-size: 28px;
    font-weight: 800;
    color: #1e1b4b;
}

.subtitle {
    margin-top: 6px;
    margin-bottom: 28px;
    font-size: 14px;
    color: #475569;
}

/* Form */
.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #334155;
}

input,
textarea {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #c7d2fe;
    font-size: 14px;
    outline: none;
}

input:focus,
textarea:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
}

/* Actions */
.actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 24px;
}

.btn {
    padding: 10px 18px;
    border-radius: 10px;
    border: none;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: white;
}

.btn-secondary {
    background: #e5e7eb;
    color: #374151;
}

.btn-primary:hover {
    transform: translateY(-1px);
}
</style>
