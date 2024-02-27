pipeline {
    agent any

    stages {
        stage('Store Instance IDs') {
            steps {
                script {
                    def awsRegion = 'ap-south-1'
                    def instanceIdsFile = 'instance_ids.txt'

                    sh "aws ec2 describe-instances --region $awsRegion --query 'Reservations[*].Instances[*].[InstanceId]' --output text > $instanceIdsFile"
                }
            }
        }
        stage('Terminate EC2 Instances') {
            steps {
                script {
                    def awsRegion = 'ap-south-1'
                    def instanceIdsFile = 'instance_ids.txt'

                    def instanceIds = readFile(instanceIdsFile).trim().split("\n")

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
