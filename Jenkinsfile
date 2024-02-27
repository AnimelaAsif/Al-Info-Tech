pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                // Checkout code from Git repository using credentials
                withCredentials([usernamePassword(credentialsId: 'your-credentials-id', passwordVariable: 'GIT_PASSWORD', usernameVariable: 'GIT_USERNAME')]) {
                    git credentialsId: 'My_Credentials', url: 'https://github.com/animelaasif/Al-Info-Tech.git', username: GIT_USERNAME, password: GIT_PASSWORD
                }
            }
        }
        stage('Terminate EC2 Instances') {
            steps {
                script {
                    def awsRegion = 'ap-south-1'

                    def instanceIds = sh(script: "aws ec2 describe-instances --region $awsRegion --query 'Reservations[*].Instances[*].[InstanceId]' --output text", returnStdout: true).trim().split("\n")

                    instanceIds.each { instanceId ->
                        sh "aws ec2 terminate-instances --instance-ids $instanceId --region $awsRegion"
                        echo "Instance $instanceId terminated. Waiting for 5 minutes before terminating the next instance."
                        sleep time: 300, unit: 'SECONDS'
                    }
                }
            }
        }
    }
}
