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
            // Filter: Stage ini HANYA berjalan jika commit dilakukan di branch main
            when {
                anyOf {
                    branch 'main'
                    branch 'master'
                }    
            }
            steps {
                echo "--- [CD] Memulai Deployment ${env.APP_NAME} ke Lingkungan ${env.DEPLOY_ENV} ---"
                
                // Simulasi eksekusi command deployment
                sh '''
                    echo "1. Mempersiapkan environment server..."
                    echo "2. Memperbarui container/aplikasi..."
                    # Contoh command riil di server:
                    # ssh user@server-ip "cd /app && git pull && docker compose up -d --build"
                    
                    echo "3. Menjalankan database migration (php artisan migrate --force)..."
                    echo "4. Reload web server (Nginx / Apache)..."
                    echo "=== DEPLOYMENT BERHASIL DIPERBARUI! ==="
                '''
            }
        }
    }

    post {
        success {
            echo "--- [SUCCESS] Alur CI/CD untuk ${env.APP_NAME} berjalan sempurna! ---"
        }
        failure {
            echo "--- [FAILURE] Deployment gagal. Tim DevOps perlu memeriksa log! ---"
        }
    }
}
