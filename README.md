# Ansible GitHub Actions CI/CD Demo

devops/
├── .github/workflows/
│   └── deploy.yml           
├── ansible/
│   ├── inventories/
│   │   ├── production.ini   
│   │   └── staging.ini      
│   ├── roles/
│   │   └── laravel_deploy/
│   │       ├── defaults/
│   │       │   └── main.yml 
│   │       └── tasks/
│   │           ├── laravel.yml
│   │           ├── main.yml
│   │           ├── release.yml
│   │           ├── rollback.yml
│   │           └── symlink.yml
│   └── deploy.yml           
├── public/
│   └── index.php           
└── README.md

# -------------------Add this when need to prod----------------------------------

# In .github/workflows/deploy.yml

on:
  pull_request:
    branches:
      - deploy
      - main     #add main when need prod.
      
# Add this after staging
deploy-production:
    name: Deploy to Production
    if: >
      github.event.pull_request.base.ref == 'main' &&
      github.event.pull_request.merged == true
    runs-on: ubuntu-latest

    steps:
      - name: Checkout code
        uses: actions/checkout@v4

      - name: Check if Ansible is installed
        id: ansible_check
        run: |
          if command -v ansible >/dev/null 2>&1; then
            echo "installed=true" >> $GITHUB_OUTPUT
          else
            echo "installed=false" >> $GITHUB_OUTPUT
          fi

      - name: Install Ansible (if not installed)
        if: steps.ansible_check.outputs.installed == 'false'
        run: |
          sudo apt update
          sudo apt install -y ansible

      - name: Setup SSH
        run: |
          mkdir -p ~/.ssh
          echo "${{ secrets.SSH_PRIVATE_KEY }}" > ~/.ssh/id_rsa
          chmod 600 ~/.ssh/id_rsa
          ssh-keyscan -H ${{ secrets.PRODUCTION_HOST }} >> ~/.ssh/known_hosts

      - name: Deploy to Production
        run: |
          ansible-playbook \
            -i ansible/inventories/production.ini \
            ansible/deploy.yml

# In ansible/inventories/production.ini

[laravel]
production ansible_host=61.2.229.179 ansible_user=encureit-espl

# In GitHub Secrets

| Secret            | Required   | Why            |
| ----------------- | ---------  | -------------- |
| `SSH_PRIVATE_KEY` | ✅         | SSH access     |
| `STAGING_HOST`    | ✅         | Staging deploy |
| `PRODUCTION_HOST` | ✅         | Prod deploy    |
