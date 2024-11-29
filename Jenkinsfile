pipeline {
    agent any

    environment {
        // Docker Hub credentials
        //DOCKER_HUB_CREDS = credentials('docker-hub-credentials')
        DOCKER_IMAGE_NAME = 'moinick/ecommerce-app'
        DOCKER_TAG = 'latest'

        /* Environment Variables
        DB_HOST = '127.0.0.1'
        DB_PORT = '3306'
        DB_DATABASE = 'ecommerce_php'
        DB_USERNAME = 'root'*/
    }

    tools {
        nodejs 'NodeJS 14'
    }

    stages {
        stage('Checkout Code') {
            steps {
                git branch: 'feature/dockercicd', url: 'https://github.com/moinickcres/ecommerce-app.git'
            }
        }

        stage('Prepare Environment') {
            steps {
                writeFile file: '.env.testing', text: '''
                APP_ENV=testing
                APP_KEY=base64:3ehjP84XOuio4SXW2ni2AJm96Oq12N9V+3IuyZ3bd7s=

                DB_CONNECTION=mysql
                DB_HOST=127.0.0.1
                DB_PORT=3306
                DB_DATABASE=ecommerce_php
                DB_USERNAME=root
                '''
                bat '''
                composer install
                '''
            }
        }

        stage('Install Node.js and NPM') {
            steps {
                bat '''
                npm install
                npm run production
                '''
            }
        }

        stage('Verify Database Connection') {
            steps {
                bat '''
                php artisan tinker --env=testing --execute="DB::connection()->getPdo();"
                php artisan tinker --env=testing --execute="DB::table('users')->get();"
                '''
            }
        }

        /*stage('Run Migrations') {
            steps {
                bat 'php artisan migrate --env=testing --pretend' // --pretend is simulating changes without applying them
            }
        }*/

        stage('Start Laravel Server') {
            steps {
                bat 'start /B php artisan serve --host=127.0.0.1 --port=8000'
            }
        }


        stage('Run Tests') {
            steps {
                bat 'php artisan test --env=testing'
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
