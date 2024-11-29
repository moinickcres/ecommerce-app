pipeline {
    agent any

    environment {
        // Docker Hub credentials
        //DOCKER_HUB_CREDS = credentials('docker-hub-credentials')
        DOCKER_IMAGE_NAME = 'moinick/ecommerce-app'
        DOCKER_TAG = 'latest'

        // Environment Variables
        DB_HOST = '127.0.0.1'
        DB_PORT = '3306'
        DB_DATABASE = 'ecommerce_php'
        DB_USERNAME = 'root'
    }

    stages {
        stage('Checkout Code') {
            steps {
                git branch: 'feature/dockercicd', url: 'https://github.com/moinickcres/ecommerce-app.git'
            }
        }

        stage('Set Up PHP') {
            steps {
                bat '''
                composer install
                php artisan key:generate
                '''
            }
        }

        stage('Verify Database Connection') {
            steps {
                bat '''
                php artisan tinker --execute="DB::connection()->getPdo();"
                '''
            }
        }

        stage('Run Migrations') {
            steps {
                bat 'php artisan migrate --env=testing'
            }
        }

        stage('Start Laravel Server') {
            steps {
                bat 'start /B php artisan serve --host=127.0.0.1 --port=8000'
            }
        }


        stage('Run Tests') {
            steps {
                bat 'php artisan test'
            }
        }

        /*stage('Build Docker Image') {
            steps {
                bat 'docker build -t %DOCKER_IMAGE_NAME%:%DOCKER_TAG% .'
            }
        }*/

        /*stage('Push Docker Image') {
            steps {
                bat '''
                echo %DOCKER_HUB_CREDS_PSW% | docker login -u %DOCKER_HUB_CREDS_USR% --password-stdin
                docker push %DOCKER_IMAGE_NAME%:%DOCKER_TAG%
                '''
            }
        }*/
    }

    post {
        always {
            echo 'Pipeline completed!'
        }
        success {
            echo 'Pipeline succeeded!'
        }
        failure {
            echo 'Pipeline failed!'
        }
    }
}
