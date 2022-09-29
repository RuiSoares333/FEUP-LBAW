# ER: Requirements Specification

The Super Legit Collaborative News (SLCN) is a project headed by a small group of developers with the main goal of free, open, and accessible news sharing for and by users.

This will allow all users to view and browse the top and most recent news and comments on any topic, with access to text search and category filtering.

# A1: Super Legit Collaborative News (SLCN)

The Super Legit Collaborative News (SLCN) is a project headed by a small group of developers with the main goal of free, open, and accessible news sharing for and by users.

This will allow all users to view and browse the top and most recent news and comments on any topic, with access to text search and category filtering.

On top of that, authenticated users will be able to post news and comments of their own, as well as vote on any of them.
They will have access to a profile, housing their information, profile picture, and reputation. There will also be a list of posted news and comments, which can be edited and deleted by the author.
They also will be able to follow other users, specific tags and categories, and view their favorite items.
Their reputation will be determined by the number of likes and dislikes on their posts and comments.
The platform will employ notifications to inform users of every like and comment on a post.

The platform will also employ administrators capable of moderating, editing, and deleting posts, comments, and user profiles. Administrators will also be in charge of managing tags and categories.

The platform will have an adaptive, responsive design to allow usage on multiple devices (desktop, smartphone, etc.) as well as an intuitive user interface and navigation.

# A2: Actors and User stories

This artifact contains the information and specification of the actors and their user stories. It also contains the projects supplementary requirements.

## 1. Actors

The actors for the Super Legit Collaborative News (SLCN) project are represented in Figure 1 and described in Table 1.
<p  align="center">
    <img src="./pictures/actor_diagram.svg">
    <figcaption align = "center">Figure 1: SLCN actors</figcaption>
</p>
<br>

<p>

|Identifier| Description|
| --- | --- |
| User | Generic User that can view and search news items and comments |
| Visitor | Unauthenticated user that can sign-in or sign-up |
| Authenticated User| Authenticated user that can also make a new post, comment on a post, vote on a post or comment, has access to a profile, can follow and unfollow users and categories and has a reputation|
| News Author | Authenticated User that can also edit and delete their news posts|
| Comment Author | Authenticated User that can also edit and delete their comments |
| Administrator | Authenticated user that is responsible for the moderation of the users and their content. They can edit or delete posts and comments of any user, aswell as their profiles and manage tags and categories|
<figcaption align = "center">Table 1: SLCN actors description</figcaption>
</p>

## 2. User Stories

For the SLCN project, the considered user stories are presented below.

<p>
<br>

### 2.1 User

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US01 | See Home Feed | High | As a user I want to access the home page, so that I can see all the news and options available. |
| US02 | View News Item | High | As a User I want to access a single News Item so that I can read a more detailed version with a description. |
| US03 | Sort home feed by popularity | High | As a User I want to sort the news by popularity so that I can have access to the most relevant topics at the moment. |
| US04 | Read Comment | Medium | As a User, I want to see the comments of each news item, so that I can read them. |
| US05 | Search | Medium | As a User I want to the search for a specific category, commentary or news item so that I can find that information quicker.  |
| US06 | Sort news feed by recent  | Medium | As a User I want to sort the news by most recent so I can have access to the newest topics. |

<figcaption align = "center">Table 2: User's user stories</figcaption>

</p>
<p>
<br>

### 2.2 Visitor

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US07 | Sign-in | High | As a Visitor, I want to be able to authenticate so that I can interact with the news items. |
| US08 | Sign-up | High | As a Visitor, I want to be able to create an account in the system so that I can authenticate. |
| US09| Recover Password | Medium | As a Visitor, I want to be able to recover my password, so that I can keep my account in case I have forgot how to access it. |
<figcaption align = "center">Table 3: Visitor's user stories</figcaption>
</p>
<p>
<br>

### 2.3 Authenticated User

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US10 | Create News Item | High | As a Authenticated User, I want to create and publish a news item, so that it becomes available to other users. |
| US11 | Logout | High | As a Authenticated User, I want to logout from my account, so that I can leave. |
| US12 | Edit Profile | High | As a Authenticated User, I want to edit my profile so that I can keep my personal information updated. |
| US13 | View Profile | High | As a Authenticated User, I want to View user profiles so that I can check my own personal information and that of other Users. |
| US14 | View other users' profile | High | As a Authenticated User, I want to view the profiles of other people, so that I can check their post and comment history. |
| US15 | Create a Comment | Medium | As a Authenticated User, I want to create and publish a comment, so that it becomes available for other users to read. |
| US16 | Vote on News Item | Medium | As a Authenticated User, I want to like or dislike a news item, so that I can declare my opinion on it. |
| US17 | Remove Vote on News Item | Medium | As a Authenticated User, I want to remove my vote on a news item, so that it is removed from the platform. |
| US18 | Vote on Comment | Medium | As a Authenticated User, I want to like or dislike a comment, so that I can declare my opinion on it. |
| US19 | Remove Vote on Comment | Medium | As a Authenticated User, I want to remove my vote on a comment, so that it is removed from the platform. |
| US20 | Delete Account | Medium | As a Authenticated User I want to be able to delete my account so that I can delete my personal data of the platform. |
| US21 | Administrator Accounts | Medium | As a Authenticated User, I want to apply for an Administrator Account so that I can become an administrator. |
| US22 | Follow other peoples profile | Medium | As a Authenticated User, I want to follow other peoples profile so that I can easily access their posts. |
| US23 | Unfollow other peoples profile | Medium | As a Authenticated User, I want to unfollow other peoples profile so that I can stop seeing news from people that I don't like. |
| US24 | Profile Picture | Medium | As a Authenticated User, I want to edit my own profile picture so that others can myself or my interests when visiting my profile or viewing my posts and comments. |
<figcaption align = "center">Table 4: Authenticated User's user stories</figcaption>
</p>
<p>
<br>

### 2.4 News Author

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US25 | Edit News Item | High | As a News Author, I want to edit one of my published articles, so that I can correct/update said article. |
| US26 | Delete News Item | High | As a News Author, I want to remove one of my published articles, so that it disappears from the platform. |
| US27 | News Vote Notification | Medium | As a News Author, I want to receive a notification whenever someone votes on a news item I posted, so that I'm aware of its popularity. |
| US28 | News Comment Notification | Medium | As a News Author, I want to receive a notification whenever someone comments on one of my news items, so that I can read it immediately. |
<figcaption align = "center">Table 5: News Author's user stories</figcaption>
</p>
<p>
<br>

### 2.5 Comment Author

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US29 | Edit Comment | Medium | As a Comment Author, I want to edit one of my published comments, so that I can correct/update said comment. |
| US30 | Remove Comment | Medium | As a Comment Author, I want to remove one of my published comments, so that it disappears from the platform. |
| US31 | Comment Vote Notification | Medium | As a Comment Author, I want to receive a notification whenever someone votes on a comment I posted, so that I'm aware of its popularity. |
| US32 | News Comment Notification | Low | As a News Author, I want to receive a notification whenever someone comments on one of my comments, so that I can read it immediately. |
<figcaption align = "center">Table 6: Comment Author's user stories</figcaption>

</p>
<p>
<br>

### 2.6 Administrator

|Identifier | Name| Priority|  Description|
| --- | --- | --- | --- |
| US33 | Administer User Accounts | High | As an Administrator, I want to search, view and edit user Accounts so that I can keep manage users. |
| US34 | Manage Topic Proposals | Medium | As an Administrator, I want to manage the topic proposals so that I can add or delete them. |
| US35| Block User Accounts | Medium | As an Administrator, I want to block user accounts so that they can't disturb anyone anymore. |
| US36 | Unblock User Accounts | Medium | As an Administrator, I want to unblock user accounts so that they can interact with the other again. |
| US37 | Delete User Account | Medium | As an Administrator, I want to delete user accounts in order to moderate the forums so that if an user in question disobeys the user guidelines he can't disturb the forums anymore. |
<figcaption align = "center">Table 7: Administrators's user stories</figcaption>
</p>

## 3. Supplementary Requirements

This section contains the business rules, technical requirements and restrictions of the project.

<p>
<br>

### 3.1 Business Rules

</p>

|Identifier | Name| Description|
| --- | --- | --- |
| BR01 | User Reputation | User reputation should be derived from the number of likes and dislikes received by a user on their posts and comments. |
| BR02 | Deleting posts and comments | A post or comment cannot be deleted by its author if it has likes or comments. |
| BR03 | Account deletion | On accound deletion, posts, likes, dislikes and comments should be kept in the platform but marked as anonymous. |
| BR04 | Category on posts | To post a news item, the author most select at least one category.|
| BR05 | Vote/comment on own items | A News item or comment author has the ability to vote and comment on their own items. |
<figcaption align = "center">Table 8: Business rules</figcaption>
<p>
<br>

### 3.2 Technical Requirements

</p>

|Identifer | Name| Description|
| --- | --- | --- |
| TR01 | Performance | The system should have response times shorter than 2s to ensure the user's attention.|
|TR02 | Robustness | The system must be prepared to handle and continue operating when runtime errors occur. |
| **TR03** | **Scalability** | **The system must be prepared to deal with the growth in the number of users and their actions. <br><br> Considering the nature of the project as a collaborative news websire, the ability to accommodate an increasng number of users is paramount.** |
| TR04 | Accessibility | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use. |
| **TR05** | **Usability** | **The system should be intuitive and easy to use.<br><br> Viewing the project as a collaborative news website, any user should be able to use it regardless of background or experience.** |
| **TR06** | **Database** | **The PostgreSQL database management system must be used.<br><br>Considering the news, user information, comments and votes that are integral to the website as well as their relations to each other, it is important to develop and utilize a robust and well thought out database to accommodate those needs.** |
|TR07 | Security | The system must protect the users information from unauthorised access as well as employ authentication and verification features. |
<figcaption align = "center">Table 9: Technical Requirements</figcaption>
<p>
<br>

### 3.3 Restrictions

| Identifier | Name | Description |
| --- | --- | --- |
| C01 | Deadine | The system should be ready by the week of 02/01/2023 to be submited for evaluation. |
<figcaption align = "center">Table 10: Project Restrictions</figcaption>
</p>

# Team

- André Morais, up202005303@edu.fe.up.pt
- João Teixeira, up202005437@edu.fe.up.pt
- Lucas Sousa, up202004682@edu.fe.up.pt
- Rui Soares, up202103631@edu.fe.up.pt

#### lbaw2223-t8g6, 27/09/22
