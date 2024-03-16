pipeline {
    agent any
    stages {
        stage('check the list of images') {
            steps {
                dir('/var/lib/jenkins/workspace/Al-info/img/') {
                    sh "sh image-list.sh"
                    sh "sh image-write.sh"
                }
            }
        }
        stage('push the latest changes to git') {
            steps {
                sh "git add ."
                sh "git commit -m 'added the latest images'"
                sh "git push"
            }
        }

        stage('Store Running Instance IDs') {
            steps {
                script {
                    def awsRegion = 'ap-south-1'
                    def instanceIdsFile = 'running_instance_ids.txt'
                    sh "aws ec2 describe-instances --region $awsRegion --query 'Reservations[*].Instances[?State.Name==`running`].[InstanceId]' --output text > $instanceIdsFile"
                    sh "cat $instanceIdsFile"
                }
            }
        }
        stage('Terminate EC2 Instances') {
            steps {
                script {
                    def awsRegion = 'ap-south-1'
                    def instanceIdsFile = 'running_instance_ids.txt'
                    def instanceIds = readFile(instanceIdsFile).trim().split("\n")
                    instanceIds.each { instanceId ->
                        sh "aws ec2 terminate-instances --instance-ids $instanceId --region $awsRegion"
                        echo "Instance $instanceId terminated."
                        echo "Waiting for 3 minutes before terminating the next instance."
                        sleep time: 180, unit: 'SECONDS'
                    }
                }
            }
        }
    }
}