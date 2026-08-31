# aws-quick-loan-project
AWS QuickLoan – Cloud-Based Loan Application


**AWS QuickLoan – Cloud-Based Loan Application**

**Overview:**
Developed and deployed a web-based loan application system where users can view loan products and submit applications online. The application uses PHP and MySQL/MariaDB for backend processing and data storage, with AWS infrastructure configured for scalability and availability.

**AWS Services & Technologies:**

* **Amazon EC2** – Application and database servers
* **Amazon VPC** – Isolated cloud network
* **Subnets & Route Tables** – Public/private network segmentation
* **Internet Gateway** – Internet access for public resources
* **NAT Gateway** – Outbound access for private resources
* **Security Groups** – Network-level access control
* **Amazon S3** – Application file storage
* **Amazon Route 53** – Domain name and DNS routing
* **Application Load Balancer** – Traffic distribution
* **Auto Scaling Group** – Automatic EC2 scaling
* **Nginx** – Web server
* **PHP & MySQL/MariaDB** – Application and database layer

**Architecture Flow:**
`User → Route 53 → Load Balancer → EC2 Web Servers → PHP Application → Database Server`

**Infrastructure Flow:**
`VPC → Public/Private Subnets → Route Tables → IGW/NAT Gateway → EC2`

**Scaling Flow:**
`Traffic → Load Balancer → Auto Scaling Group → EC2 Instances`

**Resume Highlights:**

* Deployed a PHP-based loan application on AWS using EC2, Nginx, and MySQL/MariaDB.
* Designed a VPC with public/private subnets, route tables, Internet Gateway, NAT Gateway, and security groups.
* Configured Route 53, Load Balancer, and Auto Scaling Group for scalable application access.
