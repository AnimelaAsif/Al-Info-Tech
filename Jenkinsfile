pipeline {
    agent any

    stages {
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
