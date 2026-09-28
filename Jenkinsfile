pipeline {
    agent any

    stages {
        stage('Persiapan') {
            steps {
                echo 'Halo dari tahap Persiapan!'
                sh 'echo "Ini adalah eksekusi shell di dalam pipeline..."'
            }
        }
        stage('Build') {
            steps {
                echo 'Sedang mem-build aplikasi...'
                sh 'sleep 3' // Simulasi proses build berjalan selama 3 detik
            }
        }
        stage('Test') {
            steps {
                echo 'Menjalankan unit testing...'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Sukses! Aplikasi seolah-olah sudah di-deploy.'
            }
        }
    }
}
