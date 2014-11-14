
{{{ TOC }}}

{{{ DOCSTART }}}
[[setvar key="title" value="Software Architecture Document"]]
[[setvar key="project" value="Broking Club"]]
[[setvar key="version" value="1.0"]]

# [[$title]]
* Project: __[[$project]]__
* Document Version: __[[$version]]__

{{{ STARTCONTENT }}}

```Note: The following template is provided for use with the Rational Unified Process.  Text enclosed in square brackets and displayed in blue italics (style=InfoBlue) is included to provide guidance to the author and should be deleted before publishing the document. A paragraph entered following this style will automatically be set to normal (style=Body Text).```


# Introduction

```The introduction of the Software Architecture Document should provide an overview of the entire Software Architecture Document. It should include the purpose, scope, definitions, acronyms, abbreviations, references, and overview of the Software Architecture Document.```

## Purpose

This document provides a comprehensive architectural overview of the system, using a number of different architectural views to depict different aspects of the system.  It is intended to capture and convey the significant architectural decisions which have been made on the system.

```This section defines the purpose of the Software Architecture Document, in the overall project documentation, and briefly describes the structure of the document. The specific audiences for the document should be identified, with an indication of how they are expected to use the document.```

## Scope

```A brief description of what the Software Architecture Document applies to; what is affected or influenced by this document.```

## Definitions, Acronyms and Abbreviations

```This subsection should provide the definitions of all terms, acronyms, and abbreviations required to properly interpret the Software Architecture Document.  This information may be provided by reference to the project Glossary.```

## References

```This subsection should provide a complete list of all documents referenced elsewhere in the Software Architecture Document.  Each document should be identified by title, report number (if applicable), date, and publishing organization.  Specify the sources from which the references can be obtained. This information may be provided by reference to an appendix or to another document.```

## Overview

```This subsection should describe what the rest of the Software Architecture Document contains and explain how the Software Architecture Document is organized.```

# Architectural Representation

```This section describes what software architecture is for the current system, and how it is represented. Of the Use-Case, Logical, Process, Deployment, and Implementation Views, it enumerates the views that are necessary, and for each view, explains what types of model elements it contains.```

# Architectural Goals and Constraints

```This section describes the software requirements and objectives that have some significant impact on the architecture, for example, safety, security, privacy, use of an off-the-shelf product, portability, distribution, and reuse. It also captures the special constraints that may apply: design and implementation strategy, development tools, team structure, schedule, legacy code, and so on.```

# Use-Case View

```This section lists use cases or scenarios from the use-case model if they represent some significant, central functionality of the final system, or if they have a large architectural coverage - they exercise many architectural elements, or if they stress or illustrate a specific, delicate point of the architecture.```


```This section describes one or more physical network (hardware) configurations on which the software is deployed and run. It is a view of the Deployment Model. At a minimum for each configuration it should indicate the physical nodes (computers, CPUs) that execute the software, and their interconnections (bus, LAN, point-to-point, and so on.) Also include a mapping of the processes of the Process View onto the physical nodes.```

#  Implementation View

```This section describes the overall structure of the implementation model, the decomposition of the software into layers and subsystems in the implementation model, and any architecturally significant components.```

## Overview

```This subsection names and defines the various layers and their contents, the rules that govern the inclusion to a given layer, and the boundaries between layers. Include a component diagram that shows the relations between layers. ```

## Layers

```For each layer, include a subsection with its name, an enumeration of the subsystems located in the layer, and a component diagram.```

# Data View (optional)

```A description of the persistent data storage perspective of the system. This section is optional if there is little or no persistent data, or the translation between the Design Model and the Data Model is trivial.```

# Size and Performance

```A description of the major dimensioning characteristics of the software that impact the architecture, as well as the target performance constraints.```

# Quality

```A description of how the software architecture contributes to all capabilities (other than functionality) of the system: extensibility, reliability, portability, and so on. If these characteristics have special significance, for example safety, security or privacy implications, they should be clearly delineated.```

Artifacts >  Analysis & Design Artifact Set >  Software Architecture Document >  rup_sad.htm
  
{{{ ENDCONTENT }}}

{{{ DOCEND }}}
