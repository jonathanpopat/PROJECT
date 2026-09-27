# 🏠 Real Estate DevOps Platform

A production-style real estate web application deployed on AWS using modern DevOps practices.

The main goal of this project is not to build a complex real-estate application, but to demonstrate the complete DevOps lifecycle:

**Develop → Version Control → Containerize → Provision → Configure → CI/CD → Deploy → Monitor → Troubleshoot**

---

## 📌 Project Overview

This project implements a simple Flask-based real estate application and progressively builds a production-style AWS infrastructure around it.

### Core Technologies

- **AWS**
- **Linux / Ubuntu**
- **Git & GitHub**
- **Docker**
- **Jenkins**
- **Terraform**
- **Ansible**
- **Amazon ECR**
- **Amazon RDS PostgreSQL**
- **Application Load Balancer**
- **Amazon CloudWatch**
- **Kubernetes** *(planned V2)*

---

## 🎯 Project Objectives

The project is designed to demonstrate practical Junior DevOps Engineer skills:

- Linux server administration
- AWS infrastructure design
- Infrastructure as Code using Terraform
- Docker containerization
- CI/CD using Jenkins
- Configuration management using Ansible
- Git-based development workflow
- AWS networking and security
- Database deployment using RDS
- Application monitoring using CloudWatch
- Troubleshooting real-world infrastructure failures
- Kubernetes-based deployment as a future version

---

# 🏗️ Architecture

### Current Target Architecture

```text
                         INTERNET
                            │
                            ▼
                   ┌─────────────────┐
                   │ Internet Gateway│
                   └────────┬────────┘
                            │
                    ┌───────▼───────┐
                    │      VPC      │
                    │  10.0.0.0/16  │
                    │                │
                    │  PUBLIC SUBNET │
                    │                │
                    │      ALB       │
                    │       │        │
                    │       ▼        │
                    │      EC2       │
                    │    Docker      │
                    │       │        │
                    │────────────────│
                    │ PRIVATE SUBNET │
                    │       │        │
                    │       ▼        │
                    │      RDS       │
                    │   PostgreSQL   │
                    └───────────────┘
```

### Traffic Flow

```text
Internet
   │
   ▼
Application Load Balancer :80
   │
   ▼
EC2 :5000
   │
   ▼
Docker Container
   │
   ▼
Flask Application
   │
   ▼
PostgreSQL RDS :5432
```

---

# 📁 Repository Structure

```text
real-estate-devops/
│
├── app/
│   ├── app.py
│   ├── requirements.txt
│   ├── Dockerfile
│   ├── .dockerignore
│   └── venv/                 # Local only - NOT committed
│
├── terraform/
│   ├── versions.tf
│   ├── provider.tf
│   ├── variables.tf
│   ├── terraform.tfvars      # Local only - NOT committed
│   ├── vpc.tf
│   ├── subnets.tf
│   ├── internet-gateway.tf
│   ├── route-tables.tf
│   ├── security-groups.tf
│   ├── ec2.tf
│   ├── alb.tf
│   ├── rds.tf
│   ├── outputs.tf
│   └── .gitignore
│
├── ansible/
│   ├── inventory
│   ├── playbook.yml
│   └── roles/
│
├── jenkins/
│   └── Jenkinsfile
│
├── scripts/
│
├── docs/
│   ├── architecture/
│   ├── deployment/
│   └── troubleshooting/
│
├── .gitignore
└── README.md
```

---

# ☁️ AWS Infrastructure

Terraform provisions the following infrastructure:

| Component | Purpose |
|---|---|
| VPC | Isolated AWS network |
| Public Subnets | ALB and application EC2 |
| Private Subnets | Database tier |
| Internet Gateway | Internet connectivity |
| Route Tables | Network traffic routing |
| Security Groups | Network-level security |
| EC2 | Application server |
| ALB | Load balancing and HTTP entry point |
| RDS PostgreSQL | Application database |
| ECR | Container image registry |
| CloudWatch | Monitoring and logging |

---

# 🔐 Security Design

The project follows basic least-access principles.

### Internet → ALB

```text
TCP 80
0.0.0.0/0
```

### ALB → Application EC2

```text
TCP 5000
Source: ALB Security Group
```

### Administrator → EC2

```text
TCP 22
Source: Administrator IP (/32)
```

### Application EC2 → RDS

```text
TCP 5432
Source: Application Security Group
```

The database is:

- In private subnets
- Not publicly accessible
- Accessible only from the application security group
- Encrypted at rest

---

# 🐍 Application

The application is a lightweight Flask web application.

Current version:

```text
Real Estate Application
Version: 1.0
Environment: Development
```

The application listens on:

```text
0.0.0.0:5000
```

---

# 🐳 Docker

The application is packaged into a Docker image.

### Build

```bash
docker build -t real-estate-app:1.0 ./app
```

### Run

```bash
docker run -d \
  --name real-estate-app \
  -p 5000:5000 \
  real-estate-app:1.0
```

### Check

```bash
docker ps
```

### Logs

```bash
docker logs real-estate-app
```

### Test

```bash
curl http://localhost:5000
```

---

# 🌿 Git Workflow

The repository follows a Git-based workflow.

Example:

```text
Feature Branch
      │
      ▼
Development
      │
      ▼
Commit
      │
      ▼
Push
      │
      ▼
Pull Request
      │
      ▼
Review
      │
      ▼
Main
```

Useful commands:

```bash
git status
git branch
git checkout -b feature/<name>
git add .
git commit -m "message"
git push
git pull
git merge
git rebase
git stash
git revert
```

---

# 🏗️ Terraform

Terraform is used to provision AWS infrastructure.

## Terraform Workflow

```text
Terraform Configuration
        │
        ▼
terraform init
        │
        ▼
terraform fmt
        │
        ▼
terraform validate
        │
        ▼
terraform plan
        │
        ▼
terraform apply
        │
        ▼
AWS Infrastructure
```

### Initialize

```bash
cd terraform
terraform init
```

### Format

```bash
terraform fmt
```

### Validate

```bash
terraform validate
```

### Review Changes

```bash
terraform plan
```

### Provision Infrastructure

```bash
terraform apply
```

### View Outputs

```bash
terraform output
```

### Destroy Lab Infrastructure

```bash
terraform destroy
```

> `terraform destroy` should only be used when the infrastructure and its data are no longer required.

---

# ⚙️ Ansible

Ansible is used for configuration management after Terraform provisions the infrastructure.

### Terraform

```text
Provision Infrastructure
        ↓
EC2 Created
```

### Ansible

```text
Configure EC2
        ↓
Install Docker
Configure Users
Configure Services
Deploy Configuration
```

This demonstrates the distinction:

**Terraform → Infrastructure Provisioning**

**Ansible → Configuration Management**

---

# 🔄 CI/CD Pipeline

Jenkins will automate the application delivery process.

### Planned Pipeline

```text
Developer
   │
   ▼
GitHub
   │
   ▼
Jenkins
   │
   ├── Checkout
   ├── Lint
   ├── Unit Tests
   ├── Docker Build
   ├── Security Scan
   ├── Push Image
   │
   ▼
Amazon ECR
   │
   ▼
EC2 / Docker
   │
   ▼
Health Check
```

### Jenkins Pipeline Stages

1. Checkout source code
2. Install dependencies
3. Run tests
4. Build Docker image
5. Scan image
6. Authenticate with ECR
7. Push image to ECR
8. Deploy application
9. Perform health check

---

# 📊 Monitoring

Amazon CloudWatch will be used for:

- EC2 CPU utilization
- Memory utilization
- Disk utilization
- Application logs
- System logs
- Alerts and alarms

Example:

```text
High CPU
   │
   ▼
CloudWatch Alarm
   │
   ▼
Investigate
   │
   ├── Linux processes
   ├── Docker containers
   ├── Application logs
   └── System resources
```

---

# 🧪 Troubleshooting Scenarios

The project intentionally documents common infrastructure failures.

### Docker

```text
Container won't start
        ↓
docker ps -a
        ↓
docker logs
        ↓
Identify failure
        ↓
Fix
```

### Linux

Commands used:

```bash
systemctl
journalctl
ps
top
free
df
du
ss
curl
chmod
chown
```

### AWS / ALB

Example:

```text
ALB returns 503
       ↓
Target unhealthy
       ↓
Check target health
       ↓
Check Security Group
       ↓
Check port 5000
       ↓
Check Docker
       ↓
Check application
```

### Terraform

```text
terraform plan
      ↓
Unexpected resource change
      ↓
Inspect configuration
      ↓
Inspect state
      ↓
Correct configuration
      ↓
terraform apply
```

---

# 🔒 Secrets & Credentials

The following must **never** be committed to GitHub:

```text
*.pem
terraform.tfvars
.env
AWS access keys
AWS secret keys
database passwords
private keys
Terraform state files
```

The repository `.gitignore` is configured to prevent accidental commits of sensitive files.

For production CI/CD, credentials should be provided through secure AWS/Jenkins mechanisms rather than hardcoded into source code.

---

# 🚀 Project Roadmap

## Phase 1 — Application

- [x] Flask application
- [x] Local application testing
- [x] Python virtual environment

## Phase 2 — Git

- [x] Git repository
- [x] GitHub repository
- [ ] Branching workflow
- [ ] Pull requests

## Phase 3 — Docker

- [x] Dockerfile
- [x] Docker image
- [x] Container deployment
- [ ] Image optimization
- [ ] Security scanning

## Phase 4 — AWS

- [ ] VPC
- [ ] Subnets
- [ ] Security Groups
- [ ] EC2
- [ ] ALB
- [ ] RDS

## Phase 5 — Terraform

- [ ] Infrastructure provisioning
- [ ] Variables
- [ ] Outputs
- [ ] State management
- [ ] Modularization

## Phase 6 — Ansible

- [ ] Inventory
- [ ] Playbooks
- [ ] Docker installation
- [ ] Server configuration
- [ ] Application deployment

## Phase 7 — Jenkins

- [ ] Jenkins installation
- [ ] GitHub integration
- [ ] CI pipeline
- [ ] Docker build
- [ ] ECR push
- [ ] Automated deployment

## Phase 8 — Monitoring & Security

- [ ] CloudWatch
- [ ] Application logs
- [ ] Resource alarms
- [ ] Linux hardening
- [ ] Docker security
- [ ] IAM least privilege

## Phase 9 — Kubernetes V2

- [ ] Kubernetes fundamentals
- [ ] Deployment
- [ ] Service
- [ ] ConfigMap
- [ ] Secrets
- [ ] Ingress
- [ ] Rolling updates

---

# 🎓 Skills Demonstrated

By completion, this project demonstrates practical knowledge of:

### Cloud

- AWS VPC
- EC2
- ALB
- RDS
- ECR
- IAM
- CloudWatch
- Security Groups

### Linux

- Ubuntu administration
- SSH
- Users and permissions
- Services
- Networking
- Processes
- Disk and memory troubleshooting
- Logs

### DevOps

- Git
- GitHub
- Docker
- Jenkins
- Terraform
- Ansible
- CI/CD
- Infrastructure as Code
- Configuration Management
- Monitoring

### Future

- Kubernetes
- Container orchestration
- Rolling deployments
- Ingress
- Secrets management

---

# 💼 Resume Description

> **Production-Style Real Estate DevOps Platform | AWS, Terraform, Docker, Jenkins, Linux, Ansible**
>
> Designed and deployed a containerized Flask application on AWS using Terraform-based infrastructure provisioning, Docker containerization, AWS networking, ALB, EC2 and private RDS PostgreSQL. Implemented CI/CD automation with Jenkins, configuration management with Ansible, and CloudWatch-based monitoring while documenting Linux, Docker, networking and AWS troubleshooting scenarios.

---

# 📸 Recommended GitHub Documentation

The final repository should include screenshots/diagrams for:

1. AWS architecture
2. Terraform plan/apply
3. VPC and subnet layout
4. EC2 instance
5. ALB target health
6. Docker containers
7. Jenkins pipeline
8. ECR repository
9. CloudWatch dashboard
10. Successful application deployment

---

# ⚠️ Cost Management

This project uses AWS resources that can incur charges.

Pay particular attention to:

- RDS
- Application Load Balancer
- NAT Gateway if introduced later
- Public IPv4 addresses
- CloudWatch
- ECR storage

For temporary learning environments, destroy resources when they are no longer required:

```bash
terraform destroy
```

Always verify the Terraform plan before approving destructive operations.

---

# 📄 Project Status

**Current stage:** Development / Infrastructure Build

**Target:** Production-style Junior DevOps portfolio project

**Primary deployment:** AWS + Docker

**CI/CD:** Jenkins

**Infrastructure:** Terraform

**Configuration Management:** Ansible

**Future orchestration:** Kubernetes

---

## 👨‍💻 Author

**jp**

Built as a practical DevOps portfolio project focused on AWS, Linux, automation, containerization, infrastructure as code, CI/CD, security and troubleshooting.
