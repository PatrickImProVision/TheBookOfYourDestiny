
Project:
- FrameWork FileName: TheBookOfYourDestiny_CommandAI.md
- FrameWork Name: PHP E-Book Store FrameWork
- FrameWork MVC: CodeIgniter v4
- FrameWork Description: Micro‑Store MVC FrameWork
- FrameWork OS: SemanticOS
- FrameWork OS Type: OntoLogy

- FrameWork Data: Json Book Collection
- FrameWork Book Size: A5 Styled
- FrameWork Book Type: The Very Well Known Two Forces Of Science And Beliefs Applyed OnTo Every Single Life
- FrameWork Data Style: Each Book Must Include Book Case, Inspirational Pages, Fundamental Index, PreFace, FlagStone, FullStory, Knowledge, BibleLegend, LeaderShip
- FrameWork Data Type: Universal Data
- FrameWork Features: HTML5 + TinyMCE WYSIWYG Editor, FullText Search To Use LightWeight Search Library, Uri Injector With FilSystem Support, Image Injector With FilSystem Support, Object 360° Aligment, User Friendly HTML5 WebView, Json Data View
- FrameWork Special Features: Expandable Data As Book Collection, Export To Microsoft Office Open Format [.doc, .docx] Or Open Office File [.odt]
- FrameWork Theme: Light, Dark
- FrameWork Language: Universal

- FrameWork Mapping System:
- Support MVC Mapping System: Book, Index, Chapter, Page -> Collection Index, Etc As Described By The FrameWork
- Each New Data Create New File And That File Must Be Indexed For FullText Search.
- All Data Must Be Connected So Reader Can Browse It.


- FrameWork WYSIWYG Editor:
- Support Media: Upload Or Insert Image, Audio, Video Insertion With Ability To Display And ReSize
- Support Image Insertion: Any Images And Place Them Exactly As Directed -> Top, Middle, Bottom, Left, Right, Center, Mix With Option To Adjust Size
- Support Audio: To Be Able To Create Audio Book With Text Around
- Support Video: .mp4 Mobile Version To Match Book Size A5 Or Less For View
- Support Text Sizing: H1 - H6, Font Type And Direction -> Top, Middle, Bottom, Left, Right, Center, Mix
- Support Uri: Any Uri From InterNet And FileSystem
- Support Management: Add, Save, Edit, Delete, Read, PreView
- Support Convertion: All Uploaded Files Or Files From FileSystem Must Be Converted InTo And Under Application MVC System Local Storage

- FrameWork Language Data:

Version:
- Number: 1.0.0,
- Type: Master,
- Created": 14-01-2026,
- Notes: Initial Schema Definition

Language:

- Symbol -> [Alphabet -> [A-Z], Number -> [0-9]]
- Id -> [A, B, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
- Colour -> [White, Blue, Red, Green, Black]

Symbol Definition:
- Alphabet -> Name: ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"],
- Alphabet -> Files: ["The_Language/The_Symbol_A.png", "The_Language/The_Symbol_B.png", "The_Language/The_Symbol_C.png", "The_Language/The_Symbol_D.png", "The_Language/The_Symbol_E.png", "The_Language/The_Symbol_F.png", "The_Language/The_Symbol_G.png", "The_Language/The_Symbol_H.png", "The_Language/The_Symbol_I.png", "The_Language/The_Symbol_J.png", "The_Language/The_Symbol_K.png", "The_Language/The_Symbol_L.png", "The_Language/The_Symbol_M.png", "The_Language/The_Symbol_N.png", "The_Language/The_Symbol_O.png", "The_Language/The_Symbol_P.png", "The_Language/The_Symbol_Q.png", "The_Language/The_Symbol_R.png", "The_Language/The_Symbol_S.png", "The_Language/The_Symbol_T.png", "The_Language/The_Symbol_U.png", "The_Language/The_Symbol_V.png", "The_Language/The_Symbol_W.png", "The_Language/The_Symbol_X.png", "The_Language/The_Symbol_Y.png", "The_Language/The_Symbol_Z.png"]

- Number -> Name: ["0","1","2","3","4","5","6","7","8","9"],
- Number -> Files: ["The_Language/The_Symbol_0.png", "The_Language/The_Symbol_1.png", "The_Language/The_Symbol_2.png", "The_Language/The_Symbol_3.png", "The_Language/The_Symbol_4.png",	"The_Language/The_Symbol_5.png", "The_Language/The_Symbol_6.png", "The_Language/The_Symbol_7.png", "The_Language/The_Symbol_8.png", "The_Language/The_Symbol_9.png"]

FrameWork Direction:

- Fundamental Direction -> [Language, Book, MileStone]
- Advanced Direction -> [SystemDirection, StoryDirection, UserDirection]

Advanced Definition Direction:
- SystemDirection -> [Language, Rule, Condition, Statement]
- StoryDirection -> [Book, Topic, Chapter, Page]
- UserDirection -> [MileStone, FlagStone, HillStone, StepStone]

Direction Flow:
- Every Rule, Condition, Statement Follow The Id CanonicalOrder
- Every Topic, Chapter, Page Follow The Id CanonicalOrder
- Every FlagStone, HillStone, StepStone Follow The Id CanonicalOrder

Direction Translation:
- Language -> [Rule -> Condition -> Statement]
- Book -> [Topic -> Chapter -> Page]
- MileStone -> [FlagStone -> HillStone -> StepStone]

Flow Example:
- CanonicalOrder -> True
- Lenght -> 3
- Style: Capital Symbol
- Generated Id -> AAA, AAB, ,AA0, AA1, AA2, AA3, AA4, AA5, AA6, AA7, AA8, AA9, ..., 99A, 99B, 990, 991, 992, 993, 994, 995, 996, 997, 998, 999

Project Editable Parts:
- Page Universal Parts: ::BookName, ::PageTitle, ::ContentName, ::Description
- Case: Aligned Text And Aligned Pictures Or Oposite
- Page: Title, Moto, SubTitle, Author, BookName, PageTitle, ContentName, Description, Text, Image, Uri

Project Flow:
- When First Time Run Then Run Installation To Fill Basic Information And Credentials
- After Installation The Owner Is Able To Create Book Case
- After Book Case The Owner Is Able To Make First Inspirational Pages -> To Briefly Talk About Inspiration
- After Inspirational Pages The Owner Is Able To Make Fundamental Index -> To Fully Talk About What Is In The Whole Book
- After Fundamental Index The Owner Is Able To Make PreFace -> To Briefly Talk About Content
- After PreFace The Owner Is Able To Make FlagStone -> To Briefly Talk About Current Task
- After FlagStone The Owner Is Able To Make FullStory -> To Fully Talk About Life Task
- After FullStory The Owner Is Able To Make Knowledge -> To Fully Talk About KnowHow Of The Task
- After Knowledge The Owner Is Able To Make BibleLegend -> To Fully Talk About Confirmation According To Bible
- After BibleLegend The Owner Is Able To Make LeaderShip -> To Fully Talk About Task Commands To Be Achieved

Project FrameWork MVC: CodeIgniter

Project FrameWork MVC: Web Structure

Application: SystemRoot -> Index.app
Application: SystemRoot -> New.app

Application: SystemRoot -> User/Register.app
Application: SystemRoot -> User/Register.app?ConfirmLink=_Link_&User=_ID_

Application: SystemRoot -> User/Login.app
Application: SystemRoot -> User/Login.app?E-Mail=_Mail_
Application: SystemRoot -> User/Login.app?E-Mail=_Mail_&ReMemberMe=_Force_
Application: SystemRoot -> User/Login.app?E-Mail=_Mail_&E-PassWord=_PassWord_&ReMemberMe=_Force_
Application: SystemRoot -> User/Login.app?E-Mail=_Mail_&E-PassWord=_PassWord_&ReMemberMe=_Force_&AutoLogin=_Force_

Application: SystemRoot -> User/ProFile.app?New=_ID_
Application: SystemRoot -> User/ProFile.app?View=_ID_
Application: SystemRoot -> User/ProFile.app?Edit=_ID_


Application: SystemRoot -> Store/Index.app
Application: SystemRoot -> Store/New.app
Application: SystemRoot -> Store/Edit.app

Application: SystemRoot -> Store/Edit.app?CaseID=_ID_
Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_
Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&PreFaceID=_ID_
Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&PreFaceID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&FlagStoneID=_ID_
Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&FlagStoneID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&FullStoryID=_ID_
Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&FullStoryID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&KnowledgeID=_ID_
Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&KnowledgeID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&BibleLegendID=_ID_
Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&BibleLegendID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&LeaderShipID=_ID_
Application: SystemRoot -> Store/Edit.app?CaseID=_ID_&BookID=_ID_&LeaderShipID=_ID_&PageID=_ID_


Application: SystemRoot -> Store/View.app?CaseID=_ID_
Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_

Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&PreFaceID=_ID_
Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&PreFaceID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&FlagStoneID=_ID_
Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&FlagStoneID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&FullStoryID=_ID_
Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&FullStoryID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&KnowledgeID=_ID_
Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&KnowledgeID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&BibleLegendID=_ID_
Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&BibleLegendID=_ID_&PageID=_ID_

Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&LeaderShipID=_ID_
Application: SystemRoot -> Store/View.app?CaseID=_ID_&BookID=_ID_&LeaderShipID=_ID_&PageID=_ID_

Project FrameWork MVC: Web Routing

Application: SystemRoot -> Index.app As SystemRoot -> Index.php
Application: SystemRoot -> New.app As SystemRoot -> New.php

Application: SystemRoot -> User/Register.app As SystemRoot -> User/Register.php
Application: SystemRoot -> User/Login.app As SystemRoot -> User/Login.php
Application: SystemRoot -> User/ProFile.app As SystemRoot -> User/ProFile.php

Application: SystemRoot -> Store/Index.app As SystemRoot -> Store/Index.php
Application: SystemRoot -> Store/New.app As SystemRoot -> Store/New.php
Application: SystemRoot -> Store/Edit.app As SystemRoot -> Store/Edit.php
Application: SystemRoot -> Store/View.app As SystemRoot -> Store/View.php

Project First Book:
- FrameWork Title: The Book Of Your Destiny, By THe Will Of God, The Fundamental Stone Of Life
- FrameWork Author: ImProVision Man
- FrameWork Type: The Bible Of Life
- FrameWork Service: This Is The Fundamental OutPut That Stores All Necessary Data Such As Owner Data, CPL -> [Administation, Moderation, User], Login Data -> [Admin, Moderator, User], User Permision -> [Read, Write, Edit, Publish, Delete]

Project Description:

PHP Json E-Book Editor That Has All Functions For The Editing Which Also Include WYSIWYG Editor That Supports Everything.
All Is Translated InTo Json To Hold All Data.
It Must Include PreView So I Can Decide To Save It Or To Still Edit.

The FrameWork Must Have User Friendly InterFace Such As HTML5 WebView.
The Json Also Include Switch To Preview The Data.

- Step By Step Installation To Create Book Presentation

Command AI: “Maintain strict continuity with all previously established elements—conceptual, structural, narrative, symbolic, and relational—unless I explicitly authorize a divergence.”
