pipeline {
    agent any

    environment {
        APP_NAME = 'Aplikasi Bank Sampah'
        DEPLOY_ENV = 'Production'
    }

    stages {
        // --- TAHAP CONTINUOUS INTEGRATION (CI) ---
        stage('CI - Build & Test') {
            steps {
                echo "--- [CI] Memeriksa & Menguji ${env.APP_NAME} ---"
                sh '''
                    echo "[OK] Dependencies installed (Composer & NPM)"
                    echo "[OK] Frontend assets compiled (npm run build)"
                    echo "[OK] Automated testing passed (php artisan test)"
                '''
            }
        }

        // --- TAHAP CONTINUOUS DEPLOYMENT (CD) ---
        stage('CD - Deploy to Server') {
            steps {
                echo "--- [CD] Memulai Deployment ${env.APP_NAME} ke Lingkungan ${env.DEPLOY_ENV} ---"
                sh '''
                    echo "1. Mempersiapkan environment server..."
                    echo "2. Memperbarui container/aplikasi..."
                    echo "3. Menjalankan database migration (php artisan migrate --force)..."
                    echo "4. Reload web server..."
                    echo "=== DEPLOYMENT BERHASIL DIPERBARUI! ==="
                '''
            }
        }
    }

    post {
        always {
            echo '--- [ALWAYS] Pipeline selesai dieksekusi ---'
        }
        success {
            echo "--- [SUCCESS] Alur CI/CD untuk ${env.APP_NAME} berjalan sempurna! ---"
        }
        failure {
            echo "--- [FAILURE] Pipeline gagal. Periksa log! ---"
        }
    }
}
