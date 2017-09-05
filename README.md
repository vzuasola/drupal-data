## automation-pipelines

Welcome to automation pipelines. This repository aims to provide the base
layout for the GitLab pipeline framework.

### Description
Within this repository we provide the initial layout for a fully functional
and working pipeline. Whatever you do after implementing it is your choice.
However, take into account that modifications to the actual framework
void support as provided by IT Delivery team.
Any and all modifications that you would like to include / implement in
the pipeline framework should be presented in the form of a merge request
in our repository.

If you would like to contribute to this project, please request access
to the repository, read the [contributing](./CONTRIBUTING.md) documentation.

### Presentation
We have a presentation that you can clone from [GitLab](https://gitlab.ph.esl-asia.com/Automation-team/pipelines-introduction)
That should give you a pretty good idea on how to use our pipelines
framework. Should you see anything wrong in the presentation please don't
hesitate to bring it to my attention (eric.vansteenbergen@esl-asia.com)

## Requirements
* Artifactory repository setup and configured with user/password
* environment variables as defined in GitLab project settings for pipelines.
* access to external tools in place before usage, Sonar, Selenium, HP
Fortify, Artifactory, ...

## Usage
The preferred way to incorporate pipelines into a new project is to use
`git subtree`. The advantage of using `git subtree` is that the files
pulled in are stored in your repository. `git subtree` does not require
any changes to your workflow nor introduces new commands.

Follow the below steps to use the pipelines repository using subtree to
the letter, otherwise you'll need to configure a lot more than described.
### Add remote for automation
```
cd into your repository directory
git remote add pipelines git@gitlab.ph.esl-asia.com:Automation-team/automation-pipelines.git
```
### Setup subtree
```
git subtree add --prefix=automation pipelines master
```

### Configure your pipeline
Three files need to be correctly configured for the pipelines to work.

* `.gitlab-ci.yml`: this file defines your actual pipeline as you see it in
your browser when you go to the pipelines in your project. *Comments inside
the file*
* `package.json`: this file contains an include/exclude list to take into
consideration when building your package. *Comments inside
the file*
* `pipeline.json`: this one contains the actual tasks that get executed
in each and every configured stage, defined in `.gitlab-ci.yml` *Comments inside
the file*

### Activate your pipeline
From the root directory of your repository:
```
cp automation/.gitlab-ci.yml.dist ./.gitlab-ci.yml
cp automation/package.json.dist  automation/package.json
```

Now you only need to commit and push to your repository in order to have
pipelines working.

Please note that this will overwrite any existing file (`package.json`, and `.gitlab-ci.yml`).

Once you are done copying, you can make changes to your project's `package.json` and `.gitlab-ci.yml` to suit your application needs. If you think your changes can be used by other projects, please update the distribution files (`*.dist`) and push them to the main repo (`git@gitlab.ph.esl-asia.com:Automation-team/automation-pipelines.git`)


### Configuring environment variables
`pipeline.json` contains a lot of environment variables that are either provided by Gitlab CI or you manually need to configure for your project. 

To configure/add manually, go to your projects `Settings` -> `Pipeline`. On the `Secret variables` section, add/update the following:

| Variable                         | Possible value                                                                               | Description                                                                                                |
| -------------------------------- | -------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- |
| **ARTIFACTORY_PASSWORD**         | _Can be any string_                                                                          | Password that will be used by your project to upload to artifactory                                        |
| **SONARQUBE_URL**                | `https://sonar.ph.esl-asia.com`                                                              | URL of the SonarQube instance.                                                                             |
| **MSGREEN_AUTHORIZED_USERS**     | `any`, or comma-separated emails                                                             | List of users that are authorized to execute a stage in `pipeline.json`                                    |
| **MSGREEN_DEPLOY_USERNAME**      | _Can be any string_                                                                          | Username used by your app to trigger deployment job in Ansible Tower.                                      |
| **MSGREEN_DEPLOY_PASSWORD**      | _Can be any string_                                                                          | Password used by your app to trigger deployment job in Ansible Tower.                                      |
| **DEPLOY_DEVELOPMENT**           | `CMS: deploy - development environment`                                                      | Ansible tower job name to execute deployment to dev environment.                                           |
| **INTEGRATION_TESTS_USERNAME**   | _Can be any string_                                                                          | Username used by your app to trigger selenium job in Ansible Tower.                                        |
| **INTEGRATION_TESTS_PASSWORD**   | _Can be any string_                                                                          | Password used by your app to trigger selenium job in Ansible Tower.                                        |
| **INTEGRATION_DEVELOPMENT**      | `Execute selenium integration tests`                                                         | Ansible tower job name to execute selenium tests.                                                          |
| **DEPLOY_QA**                    | `CMS: deploy - testing environment (QA)`                                                     | Ansible tower job name to execute deployment to QA1 environment.                                           |
| **INTEGRATION_QA**               | `Execute selenium integration tests`                                                         | Ansible tower job name to execute selenium tests.                                                          |
| **DEPLOY_TCT**                   | `CMS: deploy - TCT environment`                                                              | Ansible tower job name to execute deployment to QA2/TCT environment.                                       |
| **MSORANGE_DEPLOY_USERNAME**     | _Can be any string_                                                                          | Username used by your app to trigger deployment job in Ansible Tower.                                      |
| **MSORANGE_DEPLOY_PASSWORD**     | _Can be any string_                                                                          | Password used by your app to trigger deployment job in Ansible Tower.                                      |
| **DEPLOY_UAT**                   | `CMS: deploy - uat environment`                                                              | Ansible tower job name to execute deployment to UAT environment.                                           |
| **DEPLOY_STG**                   | `CMS: deploy - staging environment`                                                          | Ansible tower job name to execute deployment to STG environment.                                           |
| **STAGING_SIGNOFF_USERS**        | `any`, or comma-separated emails                                                             | List of users that are authorized to sign-off staging deployment                                           |
| **BASELINE_BRANCH**              | `working`, `develop`                                                                         | Baseline branch of your app to be used by SonarQube, if not specified, default value is `$CI_COMMIT_REF_NAME`.         |
| **CODE_SCAN**                    | `execute-code-scan`                                                                          | Ansible tower job name to execute HP Fortify scans.                                                        |
| **SKIP_STEPS**                   | `phpunit-sonarqube`&#124;`composer,phpunit-sonarqube`&#124;`unit test,package`&#124;`yarn-install,package`&#124;`yarn-dist`    | Skip a specific step in a stage. Comma-separated value of `stage`&#124;`step` that needs to be skipped.    |
| **PHPMD_SRC**                   | `src/,templates/,app/,devtool/`    | Comma-separated values of all paths that will be analyzed by PHPMD.    |
| **PHPMD_RULES**                   | `codesize,cleancode,unusedcode,naming,design,controversial`    | Comma-separated values of rules that will be used by PHPMD.    |
| **ESLINT_SRC**                   | `core/assets/js`    | Path to run the eslint scanner.    |