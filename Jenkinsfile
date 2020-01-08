pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
                echo env.BUILD_ID
                echo BRANCH_NAME
                echo env.NODE_NAME
            }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
            }
        }
    }
}
