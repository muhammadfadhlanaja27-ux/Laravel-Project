<script setup>
import { ref } from 'vue'
import api from '../services/api'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

const login = async () => {
  try {
    const res = await api.post('/login', {
      email: email.value,
      password: password.value
    })

    localStorage.setItem('token', res.data.token)
    localStorage.setItem('user', JSON.stringify(res.data.user))

    router.push('/list-berita')
  } catch (err) {
    error.value = 'Email atau password salah'
  }
}
</script>

<template>
    <div class="login-wrapper">
        <div class="login-card">
            <h1 class="title">Masuk</h1>
            <p class="subtitle">Silakan login untuk melanjutkan</p>

            <form @submit.prevent="login">
                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        v-model="email"
                        placeholder="email@example.com"
                        required
                    />
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input
                        type="password"
                        v-model="password"
                        placeholder="••••••••"
                        required
                    />
                </div>

                <button type="submit" class="btn-login">
                    Login
                </button>

                <p v-if="error" class="error">
                    {{ error }}
                </p>
            </form>
        </div>
    </div>
</template>

<style scoped>
.login-wrapper {
    min-height: 100vh;
    background: linear-gradient(180deg, #f8fafc, #eef2ff);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: "Segoe UI", system-ui, sans-serif;
}

.login-card {
    background: white;
    width: 100%;
    max-width: 420px;
    padding: 36px;
    border-radius: 22px;
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.12);
}

.title {
    margin: 0;
    font-size: 30px;
    font-weight: 800;
    color: #1e1b4b;
}

.subtitle {
    margin-top: 6px;
    margin-bottom: 28px;
    font-size: 14px;
    color: #475569;
}

.form-group {
    margin-bottom: 18px;
}

label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #334155;
}

input {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #c7d2fe;
    font-size: 14px;
    outline: none;
}

input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
}

.btn-login {
    width: 100%;
    margin-top: 10px;
    padding: 12px;
    border-radius: 12px;
    border: none;
    font-size: 15px;
    font-weight: 700;
    color: white;
    cursor: pointer;
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
}

.btn-login:hover {
    transform: translateY(-1px);
}

.error {
    margin-top: 14px;
    font-size: 13px;
    color: #dc2626;
    text-align: center;
}
</style>
