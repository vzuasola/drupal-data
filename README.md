## automation-pipelines
#
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
* `lib/package.json`: this file contains an include/exclude list to take into
consideration when building your package. *Comments inside
the file*
* `pipeline.json`: this one contains the actual tasks that get executed
in each and every configured stage, defined in `.gitlab-ci.yml` *Comments inside
the file*

### Activate your pipeline
From the root directory of your repository:
```
mv automation/.gitlab-ci.yml .
```

Now you only need to commit and push to your repository in order to have
pipelines working.
