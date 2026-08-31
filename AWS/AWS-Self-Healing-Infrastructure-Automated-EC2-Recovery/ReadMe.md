**AWS Self-Healing Infrastructure – Automated EC2 Recovery**

**Overview:**
Built a self-healing AWS infrastructure that automatically detects EC2 resource issues and performs remediation without manual intervention. CloudWatch monitors system metrics, SNS triggers Lambda, and Lambda either restarts the affected service or replaces the EC2 instance.

**AWS Services & Technologies:**

* **Amazon EC2** – Application server
* **Amazon CloudWatch** – CPU, memory, disk monitoring and logging
* **Amazon SNS** – Alarm notifications and Lambda trigger
* **AWS Lambda** – Automated remediation
* **IAM** – EC2 and Lambda execution roles
* **Auto Scaling Group** – Instance replacement and availability
* **Elastic Load Balancer** – Traffic distribution
* **Amazon Route 53** – DNS routing
* **CloudWatch Logs** – Incident and action logging

**Self-Healing Flow:**
`EC2 → CloudWatch Monitoring → Alarm → SNS → Lambda → Remediation`

**Remediation Flow:**
`Lambda → Restart Service`
`Lambda → Replace EC2 Instance`

**Infrastructure Flow:**
`User → Route 53 → Load Balancer → Auto Scaling Group → EC2`

**Resume Highlights:**

* Implemented automated EC2 monitoring and recovery using CloudWatch, SNS, and AWS Lambda.
* Configured CPU, memory, and disk alarms to trigger automated remediation workflows.
* Implemented service restart and EC2 replacement mechanisms with CloudWatch logging and Auto Scaling.
