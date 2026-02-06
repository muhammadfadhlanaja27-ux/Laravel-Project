<script setup>
import { ref, onMounted } from "vue";
import api from "../plugins/axios";
import { useRouter } from "vue-router";

const router = useRouter();
const beritas = ref([]);

const loadData = async () => {
    const res = await api.get("/berita");
    beritas.value = res.data;
};

const hapus = async (id) => {
    if (confirm("Yakin hapus?")) {
        await api.delete(`/berita/${id}`);
        loadData();
    }
};

const logout = async () => {
    try {
        await api.post("/logout");
    } catch (e) {
        // abaikan errornya
    }

    localStorage.removeItem("token");
    router.push("/");
};

onMounted(loadData);
</script>
<template>
    <div class="container">
        <header class="header">
            <div>
                <h1 class="page-title">Daftar Berita</h1>
                <p class="subtitle">Kelola dan pantau berita terbaru</p>
            </div>

            <div class="actions">
                <button class="btn btn-primary" @click="router.push('/tambah')">
                    Tambah
                </button>
                <button class="btn btn-logout" @click="logout">
                    Logout
                </button>
            </div>
        </header>

        <div v-if="beritas.length" class="list">
            <div class="card" v-for="b in beritas" :key="b.id">
                <div class="card-header">
                    <h3>{{ b.judul }}</h3>
                </div>

                <div class="card-body">
                    <p>{{ b.isi }}</p>
                </div>

                <div class="card-footer">
                    <button class="btn btn-danger" @click="hapus(b.id)">
                        Hapus
                    </button>
                </div>
            </div>
        </div>

        <div v-else class="empty">
            📭 Belum ada berita
        </div>
    </div>
</template>
<style scoped>
.container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 24px;
    font-family: "Segoe UI", system-ui, sans-serif;
    background: linear-gradient(180deg, #f8fafc, #eef2ff);
    min-height: 100vh;
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}

.page-title {
    font-size: 36px;
    font-weight: 800;
    margin: 0;
    color: #1e1b4b;
}

.subtitle {
    margin-top: 6px;
    font-size: 15px;
    color: #475569;
}

/* Actions */
.actions {
    display: flex;
    gap: 12px;
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
    box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35);
}

.btn-primary:hover {
    transform: translateY(-1px);
}

.btn-logout {
    background: white;
    color: #be123c;
    border: 2px solid #be123c;
}

.btn-danger {
    background: #ef4444;
    color: white;
}

/* List */
.list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

/* Card */
.card {
    background: white;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-4px);
}

.card-header {
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    padding: 16px;
}

.card-header h3 {
    margin: 0;
    color: white;
    font-size: 18px;
}

.card-body {
    padding: 16px;
    color: #334155;
    line-height: 1.6;
}

.card-footer {
    padding: 14px 16px;
    border-top: 1px solid #e5e7eb;
    text-align: right;
}

/* Empty */
.empty {
    text-align: center;
    padding: 80px;
    font-size: 18px;
    color: #64748b;
}
</style>
