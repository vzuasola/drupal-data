# Configurations Setup for Marketing script based on Domain

Our current Marketing script module uses a different structure to manage marketing scripts.

> Please read through this document to fully understand how to configure your
> Marketing script

**Important**

For Frontend to identify that the marketing script applicable to specific domain or all. We need to configure respective domain in CMS while adding marketing script field name "Marketing Domain".

Please run update.php to get this field automatically added to your product marketing script configuration.


##Configuration format

* `1|www.dafabet.com`

* `2|www.liwuxiao.com`


**Note:** The format of adding domain should be same and in new line.

##Default format

Do not configure domain if you want to make the script applied for all domains.

Feature ticket here : [WBC-579](https://jira.ph.esl-asia.com/browse/WBC-579)

