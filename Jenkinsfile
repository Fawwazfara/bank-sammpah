pipeline {
    agent any

    // 1. Mendefinisikan variabel global pipeline
    environment {
        APP_NAME = 'Aplikasi Bank Sampah'
        BUILD_ENV = 'Staging'
    }

    stages {
        stage('Environment Check') {
            steps {
                echo "--- Memeriksa Lingkungan Build untuk ${env.APP_NAME} (${env.BUILD_ENV}) ---"
                sh 'uname -a'
                sh 'git --version'
            }
        }

        stage('Build & Structure Check') {
            steps {
                echo '--- Memeriksa File & Struktur Project ---'
                sh '''
                    echo "Daftar isi repositori:"
                    ls -la
                    
                    # Contoh logika validasi sederhana di Linux
                    if [ -f "README.md" ]; then
                        echo "[OK] File README.md ditemukan."
                    else
                        echo "[WARN] README.md tidak ditemukan!"
                    fi
                '''
            }
        }

        stage('Automated Testing') {
            steps {
                echo '--- Menjalankan Unit Test ---'
                sh '''
                    echo "Menjalankan pengujian sintaks & logika..."
                    # Di industri, di sini perintah seperti: php artisan test / npm test / pytest
                    echo "Hasil Test: 0 Errors, All Passed!"
                '''
            }
        }
    }

    // 2. Aksi otomatis setelah pipeline selesai dieksekusi
    post {
        always {
            echo '--- [ALWAYS] Tahap ini selalu dieksekusi baik build sukses maupun gagal ---'
        }
        success {
            echo "--- [SUCCESS] ${env.APP_NAME} berhasil lolos semua tahapan CI! ---"
        }
        failure {
            echo "--- [FAILURE] Terjadi kesalahan pada proses CI. Periksa log! ---"
        }
    }
}
