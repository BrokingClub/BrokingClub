
{{{ TOC }}}

{{{ DOCSTART }}}
[[setvar key="title" value="RUP Test Plan"]]
[[setvar key="project" value="Broking Club"]]
[[setvar key="version" value="0.0.1"]]

# [[$title]]
* Project: __[[$project]]__
* Document Version: __[[$version]]__

{{{ STARTCONTENT }}}

# Introduction  
## Purpose  
The purpose of the Iteration Test Plan is to gather all of the information necessary to plan and control the test effort for a given iteration. It describes the approach to testing the software, and is the top-level plan generated and used by managers to direct the test effort.  
This Test Plan for Broking Club supports the following objectives:  
* Identifies the items that should be targeted by the tests.  
* Identifies the motivation for and ideas behind the test areas to be covered.  
* Outlines the testing approach that will be used.  
* Lists the deliverable elements of the test project.  
  
## Scope  
* Unit testing (PHPUnit)  
* Functional testing (Cucumber)  
* Load testing  
  
## Intended Audience
* Students  
* Professors
* Open-source enthusiasts  
  
## Document Terminology and Acronyms

# Evaluation Mission and Test Motivation
`Provide an overview of the mission and motivation for the testing that will be conducted in this iteration.`  
  
## Background
`Provide a brief description of the background surrounding why the test effort defined by this Test Plan will be undertaken. Include information such as the key problem being solved, the major benefits of the solution, the planned architecture of the solution, and a brief history of the project. Where this information is defined in other documents, you can include references to those other more detailed documents if appropriate. This section should only be about three to five paragraphs in length.`
 
## Evaluation Mission
`Provide a brief statement that defines the mission for the evaluation effort in the current iteration. This statement might incorporate one or more concerns including:
 •	find as many bugs as possible
 •	find important problems, assess perceived quality risks
 •	advise about perceived project risks
 •	certify to a standard
 •	verify a specification (requirements, design or claims)
 •	advise about product quality, satisfy stakeholders
 •	advise about testing
 •	fulfill process mandates 
 •	and so forth
 Each mission provides a different context to the test effort and alters the way in which testing should be approached.
`

## Test Motivators
`Provide an outline of the key elements that will motivate the testing effort in this iteration. Testing will be motivated by many thingsquality risks, technical risks, project risks, use cases, functional requirements, non-functional requirements, design elements, suspected failures or faults, change requests, and so forth.`

# Target Test Items
The listing below identifies those test itemssoftware, hardware, and supporting product elements that have been identified as targets for testing. This list represents what items will be tested.  
`Provide a high level list of the major target test items. This list should include both items produced directly by the project development team, and items that those products rely on; for example, basic processor hardware, peripheral devices, operating systems, third-party products or components, and so forth. Consider grouping the list by category and assigning relative importance to each motivator.`

# Outline of Planned Tests
## Outline of Test Inclusions
`Provide a high level outline of the major testing planned for the current iteration. Note what will be included in the plan and record what will explicitly not be included in the section titled Outline of Test Exclusions.`

## Outline of Test Exclusions
`Provide a high level outline of the potential tests that might have been conducted but that have been explicitly excluded from this plan. If a type of test will not be implemented and executed, indicate this in a sentence stating the test will not be implemented or executed and stating the justification, such as:
 •	“These tests do not help achieve the evaluation mission.” 
 •	“There are insufficient resources to conduct these tests.” 
 •	“These tests are unnecessary due to the testing conducted by xxxx.”
 As a heuristic, if you think it would be reasonable for one of your audience members to expect a certain aspect of testing to be included that you will not or cannot address, you should note it’s exclusion: If the team agrees the exclusion is obvious, you probably don’t need to list it.
`

# Test Approach
`The Test Approach presents the recommended strategy for designing and implementing the required tests. Sections 3, Target Test Items, and 4, Outline of Planned Tests, identified what items will be tested and what types of tests would be performed. This section describes how the tests will be realized. 
 One aspect to consider for the test approach is the techniques to be used. This should include an outline of how each technique can be implemented, both from a manual and/or an automated perspective, and the criterion for knowing that the technique is useful and successful. For each technique, provide a description of the technique and define why it is an important part of the test approach by briefly outlining how it helps achieve the Evaluation Mission or addresses the Test Motivators.
 Another aspect to discuss in this section is the Fault or Failure models that are applicable and ways to approach evaluating them.
 As you define each aspect of the approach, you should update Section 10, Responsibilities, Staffing, and Training Needs, to document the test environment configuration and other resources that will be needed to implement each aspect.
`

## Testing Techniques and Types
### Function Testing
`Function testing of the target-of-test should focus on any requirements for test that can be traced directly to use cases or business functions and business rules. The goals of these tests are to verify proper data acceptance, processing, and retrieval, and the appropriate implementation of the business rules. This type of testing is based upon black box techniques; that is verifying the application and its internal processes by interacting with the application via the Graphical User Interface (GUI) and analyzing the output or results. The following table identifies an outline of the testing recommended for each application.`
**Technique Objective:**  
`Exercise target-of-test functionality, including navigation, data entry, processing, and retrieval to observe and log target behavior.`

**Technique:**  
`Execute each use-case scenario’s individual use-case flows or functions and features, using valid and invalid data, to verify that:
 •	 the expected results occur when valid data is used
 •	 the appropriate error or warning messages are displayed when 	invalid data is used
 •  	each business rule is properly applied
`

**Oracles:**  
`Outline one or more strategies that can be used by the technique to accurately observe the outcomes of the test. The oracle combines elements of both the method by which the observation can be made and the characteristics of specific outcome that indicate probable success or failure. Ideally, oracles will be self-verifying, allowing automated tests to make an initial assessment of test pass or failure, however, be careful to mitigate the risks inherent in automated results determination.`

**Required Tools:**  
`The technique requires the following tools:
 •	Test Script Automation Tool
 •	base configuration imager and restorer
 •	backup and recovery tools
 •	installation-monitoring tools (registry, hard disk, CPU, memory, and so forth)
 •	Data-generation tools
`

**Success Criteria:**  
`The technique supports the testing of:
 •   	all key use-case scenarios
 •  	all key features
`

**Special Considerations:**  
`Identify or describe those items or issues (internal or external) that impact the implementation and execution of  function test.`

### Load Testing
`Load testing is a performance test that subjects the target-of-test to varying workloads to measure and evaluate the performance behaviors and abilities of the target-of-test to continue to function properly under these different workloads.  The goal of load testing is to determine and ensure that the system functions properly beyond the expected maximum workload. Additionally, load testing evaluates the performance characteristics, such as response times, transaction rates, and other time-sensitive issues).]
 [Note:  Transactions in the following table refer to “logical business transactions”.  These transactions are defined as specific functions that an end user of the system is expected to perform using the application, such as add or modify a given contract.
`
**Technique Objective:**  
`Exercise designated transactions or business cases under varying workload conditions to observe and log target behavior and system performance data.`

**Technique:** 
`•	[Use Transaction Test Scripts developed for Function or Business 	Cycle Testing as a basis, but remember to remove unnecessary 	interactions and delays.
 •	Modify data files to increase the number of transactions or the tests to 	increase the number of times each transaction occurs.
 •	Workloads should include (for example, Daily, Weekly, Monthly and so forth) Peak loads.
 •	Workloads should represent both Average as well as Peak loads.
 •	Workloads should represent both Instantaneous and Sustained Peaks.
 •	The Workloads should be executed under different Test Environment 	Configurations.]
 
 
**Oracles:**  
`Outline one or more strategies that can be used by the technique to accurately observe the outcomes of the test. The oracle combines elements of both the method by which the observation can be made and the characteristics of specific outcome that indicate probable success or failure. Ideally, oracles will be self-verifying, allowing automated tests to make an initial assessment of test pass or failure, however, be careful to mitigate the risks inherent in automated results determination.`

**Required Tools:**  
`The technique requires the following tools:
 •	Test Script Automation Tool
 •	Transaction Load Scheduling and control tool
 •	installation-monitoring tools (registry, hard disk, CPU, memory, and so on) 
 •	resource-constraining tools (for example, Canned Heat)
 •	Data-generation tools
`

**Success Criteria:** 
`The technique supports the testing of Workload Emulation, which is the successful emulation of the workload without any failures due to test implementation problems.`

**Special Considerations:**  
`•	[Load testing should be performed on a dedicated machine or at a 	dedicated time. This permits full control and accurate measurement.
 •	The databases used for load testing should be either actual size or 	scaled equally.]
`

### Installation Testing
`Installation testing has two purposes. The first is to ensure that the software can be installed under different conditionssuch as a new installation, an upgrade, and a complete or custom installationunder normal and abnormal conditions. Abnormal conditions include insufficient disk space, lack of privilege to create directories, and so on. The second purpose is to verify that, once installed, the software operates correctly. This usually means running a number of the tests that were developed for Function Testing.`

**Technique Objective:**  
`Exercise the installation of the target-of-test onto each required hardware configuration under the following conditions to observe and log installation behavior and configuration state changes:
 •	new installation: a new machine, never installed previously with <Project Name>
 •	update: a  machine previously installed <Project Name>, same version
 •	update: a machine previously installed <Project Name>, older version
`

**Technique:**  
`•	[Develop automated or manual scripts to validate the condition of the target machine. 
 o	new: never installed
 o	same or older version already installed
 •	Launch or perform installation.
 •	Using a predetermined subset of Function Test scripts, run the transactions.]
`

**Oracles:**  
`Outline one or more strategies that can be used by the technique to accurately observe the outcomes of the test. The oracle combines elements of both the method by which the observation can be made and the characteristics of specific outcome that indicate probable success or failure. Ideally, oracles will be self-verifying, allowing automated tests to make an initial assessment of test pass or failure, however, be careful to mitigate the risks inherent in automated results determination.`

**Required Tools:**  
`The technique requires the following tools:
 •	base configuration imager and restorer
 •	installation monitoring tools (registry, hard disk, CPU, memory, and so on)
`

**Success Criteria:**  
`The technique supports the testing of the installation of the developed product in one or more installation configurations.`

**Special Considerations:**
`What <Project Name> transactions should be selected to comprise a confidence test that <Project Name> application has been successfully installed and no major software components are missing?`

# Entry and Exit Criteria
## Test Plan
### Test Plan Entry Criteria
`Specify the criteria that will be used to determine whether the execution of the Test Plan can begin.`

### Test Plan Exit Criteria
`Specify the criteria that will be used to determine whether the execution of the Test Plan is complete or that continued execution provides no further benefit.`

# Deliverables
`In this section, list the various artifacts that will be created by the test effort that are useful deliverables to the various stakeholders of the test effort. Don’t list all work products; only list those that give direct, tangible benefit to a stakeholder and those by which you want the success of the test effort to be measured.`
## Test Evaluation Summaries
`Provide a brief outline of both the form and content of the test evaluation summaries, and indicate how frequently they will be produced.`

## Reporting on Test Coverage
`Provide a brief outline of both the form and content of the reports used to measure the extent of testing, and indicate how frequently they will be produced. Give an indication as to the method and tools used to record, measure, and report on the extent of testing.`

## Change Requests
`Provide a brief outline of both the method and tools used to record, track, and manage test incidents, associated change requests, and their status.`

## Additional Work Products
### Detailed Test Results
`This denotes either a collection of Microsoft Excel spreadsheets listing the results determined for each test case, or the repository of both test logs and determined results maintained by a specialized test product.`

### Additional Automated Functional Test Scripts
`These will be either a collection of the source code files for automated test scripts, or the repository of both source code and compiled executables for test scripts maintained by the test automation product.`

# Testing Workflow
`Provide an outline of the workflow to be followed by the Test team in the development and execution of this Test Plan.]
 The specific testing workflow that you will use should be documented separately in the project's Development Case. It should explain how the project has customized the base RUP test workflow (typically on a phase-by-phase basis). In most cases, we recommend you place a reference in this section of the Test Plan to the relevant section of the Development Case. It might be both useful and sufficient to simply include a diagram or image depicting your test workflow.
 More specific details of the individual testing tasks are defined in a number of different ways, depending on project culture; for example:
 •	defined as a list of tasks in this section of the Test Plan, or in an accompanying appendix 
 •	defined in a central project schedule (often in a scheduling tool such as Microsoft Project) 
 •	documented in individual, "dynamic" to-do lists for each team member, which are usually too detailed to be placed in the Test Plan 
 •	documented on a centrally located whiteboard and updated dynamically 
 •	not formally documented at all
 Based on your project culture, you should either list your specific testing tasks here or provide some descriptive text explaining the process your team uses to handle detailed task planning and provide a reference to where the details are stored, if appropriate.
 For Master Test Plans, we recommend avoiding detailed task planning, which is often an unproductive effort if done as a front-loaded activity at the beginning of the project. A Master Test Plan might usefully describe the phases and the number of iterations, and give an indication of what types of testing are generally planned for each Phase or Iteration.
 Note: Where process and detailed planning information is recorded centrally and separately from this Test Plan, you will have to manage the issues that will arise from having duplicate copies of the same information. To avoid team members referencing out-of-date information, we suggest that in this situation you place the minimum amount of process and planning information within the Test Plan to make ongoing maintenance easier and simply reference the "Master" source material.
`

# Environmental Needs
`This section presents the non-human resources required for the Test Plan.`
## Base System Hardware
The following table sets forth the system resources for the test effort presented in this *Test Plan*.

`The specific elements of the test system may not be fully understood in early iterations, so expect this section to be completed over time. We recommend that the system simulates the production environment, scaling down the concurrent access and database size, and so forth, if and where appropriate.`

## Base Software Elements in the Test Environment
The following base software elements are required in the test environment for this *Test Plan*.

## Productivity and Support Tools
The following tools will be employed to support the test process for this *Test Plan*.

## Test Environment Configurations
The following Test Environment Configurations needs to be provided and supported for this project.

# Responsibilities, Staffing, and Training Needs
`This section presents the required resources to address the test effort outlined in the Test Plan—the main responsibilities, and the knowledge or skill sets required of those resources.`
## People and Roles
`see template`

## Staffing and Training Needs
This section outlines how to approach staffing and training the test roles for the project.
`The way to approach staffing and training will vary from project to project. If this section is part of a Master Test Plan, you should indicate at what points in the project lifecycle different skills and numbers of staff are needed. If this is an Iteration Test Plan, you should focus mainly on where and what training might occur during the Iteration.
 Give thought to your training needs, and plan to schedule this based on a Just-In-Time (JIT) approach—there is often a temptation to attend training too far in advance of its usage when the test team has apparent slack. Doing this introduces the risk of the training being forgotten by the time it's needed.
 Look for opportunities to combine the purchase of productivity tools with training on those tools, and arrange with the vendor to delay delivery of the training until just before you need it. If you have enough headcount, consider having training delivered in a customized manner for you, possibly at your own site.
 The test team often requires the support and skills of other team members not directly part of the test team. Make sure you arrange in your plan for appropriate availability of System Administrators, Database Administrators, and Developers who are required to enable the test effort.
`

# Risks, Dependencies, Assumptions and Constraints
`List any risks that may affect the successful execution of this Test Plan, and identify mitigation and contingency strategies for each risk. Also indicate a relative ranking for both the likelihood of occurrence and the impact if the risk is realized.`
`see template`

# Appendix

{{{ ENDCONTENT }}}

{{{ DOCEND }}}

