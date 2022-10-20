-------------------------------
-- Users
-------------------------------
INSERT INTO users (name, email, password, country, picture, isAdmin) 
VALUES users ("André Morais", "andre@legitmail.com", "legitandre", "Portugal", "./path/to/picture.png", true);

INSERT INTO users (name, email, password, country, picture, isAdmin) 
VALUES users ("João Teixeira", "joao@legitmail.com", "legitjoao", "Portugal", "./path/to/picture.png", true);

INSERT INTO users (name, email, password, country, picture, isAdmin) 
VALUES users ("Lucas Sousa", "lucas@legitmail.com", "legitlucas", "Portugal", "./path/to/picture.png", true);

INSERT INTO users (name, email, password, country, picture, isAdmin) 
VALUES users ("Rui Soares", "rui@legitmail.com", "legitrui", "Portugal", "./path/to/picture.png", true);



-------------------------------
-- Follows
-------------------------------
INSERT INTO follows (id1, id2) VALUES (1, 2);
INSERT INTO follows (id1, id2) VALUES (1, 3);
INSERT INTO follows (id1, id2) VALUES (1, 4);
INSERT INTO follows (id1, id2) VALUES (2, 1);
INSERT INTO follows (id1, id2) VALUES (2, 3);
INSERT INTO follows (id1, id2) VALUES (2, 4);
INSERT INTO follows (id1, id2) VALUES (3, 1);
INSERT INTO follows (id1, id2) VALUES (3, 2);

-------------------------------
-- Apply admin request
-------------------------------
INSERT INTO apply_admin_request(description, is_handled, id_user)
VALUES ("I would like to be an admin to help manage news",false,0);
INSERT INTO apply_admin_request(description, is_handled, id_user)
VALUES ("I would like to be an admin please!",true,1);
INSERT INTO apply_admin_request(description, is_handled, id_user)
VALUES ("I would like to be an admin to manage reports",false,2);
INSERT INTO apply_admin_request(description, is_handled, id_user)
VALUES ("I would like to be an admin to help manage ags",false,3);

-------------------------------
-- News
-------------------------------
INSERT INTO news (title, content, date, picture, id_author) VALUES news ("Overwatch Fan Makes LEGO Bastion Figure for Their Brother", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod lacinia at quis risus sed vulputate odio ut. 
Dignissim convallis aenean et tortor. Eu feugiat pretium nibh ipsum consequat nisl. Interdum consectetur libero id faucibus. 
Erat velit scelerisque in dictum non consectetur a.", 2022.10.20, "./path/to/picture.png", 1);

INSERT INTO news (title, content, date, picture, id_author) VALUES news ("Here’s What to Expect from Season 3 of The Witcher", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod lacinia at quis risus sed vulputate odio ut. 
Dignissim convallis aenean et tortor. Eu feugiat pretium nibh ipsum consequat nisl. Interdum consectetur libero id faucibus. 
Erat velit scelerisque in dictum non consectetur a.", 2022.10.20, "./path/to/picture.png", 2);

INSERT INTO news (title, content, date, picture, id_author) VALUES news ("The State Of Destiny 2's Festival Of The Lost Is Unacceptable","Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod lacinia at quis risus sed vulputate odio ut. 
Dignissim convallis aenean et tortor. Eu feugiat pretium nibh ipsum consequat nisl. Interdum consectetur libero id faucibus. 
Erat velit scelerisque in dictum non consectetur a.", 2022.10.20, "./path/to/picture.png", 3);

INSERT INTO news (title, content, date, picture, id_author) VALUES news ("Bleach TYBW shocks fans with brutal character deaths in episode 2", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Euismod lacinia at quis risus sed vulputate odio ut. 
Dignissim convallis aenean et tortor. Eu feugiat pretium nibh ipsum consequat nisl. Interdum consectetur libero id faucibus. 
Erat velit scelerisque in dictum non consectetur a.", 2022.10.20, "./path/to/picture.png", 4);

-------------------------------
-- news_favorite
-------------------------------
INSERT INTO news_favorite(id_user, id_news) VALUES (1, 1);
INSERT INTO news_favorite(id_user, id_news) VALUES (2, 2);
INSERT INTO news_favorite(id_user, id_news) VALUES (3, 4);
INSERT INTO news_favorite(id_user, id_news) VALUES (4, 3);

-------------------------------
-- news_vote
-------------------------------
INSERT INTO news_vote(id_user, id_news) VALUES (1, 1, true);
INSERT INTO news_vote(id_user, id_news) VALUES (1, 2, false);
INSERT INTO news_vote(id_user, id_news) VALUES (2, 2, true);
INSERT INTO news_vote(id_user, id_news) VALUES (2, 3, false);
INSERT INTO news_vote(id_user, id_news) VALUES (3, 1, true);
INSERT INTO news_vote(id_user, id_news) VALUES (3, 4, false);

-------------------------------
-- news_tag
-------------------------------
INSERT INTO news_tag (id_news, id_tag) VALUES (1, 1) -- gaming
INSERT INTO news_tag (id_news, id_tag) VALUES (2, 9) -- TV
INSERT INTO news_tag (id_news, id_tag) VALUES (2, 7) -- Celebrities
INSERT INTO news_tag (id_news, id_tag) VALUES (2, 1) -- Gaming
INSERT INTO news_tag (id_news, id_tag) VALUES (3, 1) -- Gaming
INSERT INTO news_tag (id_news, id_tag) VALUES (4, 8) -- Movies
INSERT INTO news_tag (id_news, id_tag) VALUES (4, 9) -- TV
INSERT INTO news_tag (id_news, id_tag) VALUES (4, 21) -- Anime

-------------------------------
-- comment
-------------------------------
INSERT INTO comment(content, id_news, id_comment, id_author) VALUES ("Fake news!", 0, NULL, 0);
INSERT INTO comment(content, id_news, id_comment, id_author) VALUES ("Very informative", 1, NULL, 1);
INSERT INTO comment(content, id_news, id_comment, id_author) VALUES ("Loved it!", 1, 0, 2);
INSERT INTO comment(content, id_news, id_comment, id_author) VALUES ("Source?", 2, 1, 3);

-------------------------------
-- comment_vote
-------------------------------
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (1, 1, true);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (1, 2, false);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (1, 3, true);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (2, 2, true);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (3, 1, false);
INSERT INTO comment_vote(id_user, id_comment, is_liked) VALUES (4, 1, true);

-------------------------------
-- tag
-------------------------------
INSERT INTO tag(tag_name) VALUES ("Gaming"); -- 1
INSERT INTO tag(tag_name) VALUES ("Politics"); -- 2
INSERT INTO tag(tag_name) VALUES ("Academia"); -- 3
INSERT INTO tag(tag_name) VALUES ("Memes"); -- 4
INSERT INTO tag(tag_name) VALUES ("Food"); -- 5
INSERT INTO tag(tag_name) VALUES ("Animals"); -- 6
INSERT INTO tag(tag_name) VALUES ("Celebrities"); -- 7
INSERT INTO tag(tag_name) VALUES ("Movies"); -- 8
INSERT INTO tag(tag_name) VALUES ("TV"); -- 9
INSERT INTO tag(tag_name) VALUES ("Books"); -- 10
INSERT INTO tag(tag_name) VALUES ("Technology"); -- 11
INSERT INTO tag(tag_name) VALUES ("Hardware"); -- 12
INSERT INTO tag(tag_name) VALUES ("Software"); -- 13
INSERT INTO tag(tag_name) VALUES ("Sci-Fi"); -- 14
INSERT INTO tag(tag_name) VALUES ("Fantasy"); -- 15
INSERT INTO tag(tag_name) VALUES ("Sports"); -- 16
INSERT INTO tag(tag_name) VALUES ("Photography"); -- 17
INSERT INTO tag(tag_name) VALUES ("Science"); -- 18
INSERT INTO tag(tag_name) VALUES ("DIY"); -- 19
INSERT INTO tag(tag_name) VALUES ("Music"); -- 20
INSERT INTO tag(tag_name) VALUES ("Anime"); -- 21

-------------------------------
-- tag_follow
-------------------------------
INSERT INTO tag_follow(id_user, id_tag) VALUES (0,0);
INSERT INTO tag_follow(id_user, id_tag) VALUES (1,1);
INSERT INTO tag_follow(id_user, id_tag) VALUES (2,2);
INSERT INTO tag_follow(id_user, id_tag) VALUES (3,3);
INSERT INTO tag_follow(id_user, id_tag) VALUES (4,4);
INSERT INTO tag_follow(id_user, id_tag) VALUES (5,5);

-------------------------------
-- tag_proposal
-------------------------------
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ("Wholesome","I want to tag my cat pictures",false); 
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ("Mystery","I want to tag some books with this tag",false); 
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ("Manga","I want to tag my favorite manga without using the 'books' tag",false); 
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ("Cars","This important tag is missing",false);
INSERT INTO tag_proposal(tag_name, description, is_handled) VALUES ("Anime","I want to tag my favorite anime shows without using the 'TV' tag", true); 

-------------------------------
-- tag_proposal_user
-------------------------------
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (1, 1);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (2, 1);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (3, 1);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (1, 2);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (2, 2);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (3, 3);
INSERT INTO tag_proposal_user(id_user, id_tag) VALUES (4, 3);

-------------------------------
-- report -- 
--'UserReport', 'NewsReport', 'CommentReport'
-------------------------------
INSERT INTO report(report_type, report_text, is_handled, id_author, id_user, id_news, id_comment) VALUES ('UserReport','User insulted me', false,0,0,NULL, NULL);
INSERT INTO report(report_type, report_text, is_handled, id_author, id_user, id_news, id_comment) VALUES ('NewsReport','Wrong use of tags', true,1,NULL,1, NULL);
INSERT INTO report(report_type, report_text, is_handled, id_author, id_user, id_news, id_comment) VALUES ('CommentReport','Offensive comment', false,2,NULL,NULL,0);
INSERT INTO report(report_type, report_text, is_handled, id_author, id_user, id_news, id_comment) VALUES ('CommentReport','Spam', false,3 , NULL, NULL, 1);

-------------------------------
-- notification
-- 'NewsVote', 'CommentVote', 'NewsComment'
-------------------------------
INSERT INTO notification(notification_type, is_viewed, id_user, id_news, id_comment) VALUES (NewsVote, false, 1, 1, NULL);
INSERT INTO notification(notification_type, is_viewed, id_user, id_news, id_comment) VALUES (CommentVote, false, 2, NULL, 3);
INSERT INTO notification(notification_type, date, is_viewed, id_user, id_news, id_comment) VALUES (NewsComment, 2022.10.20, true, 2, NULL, 1);
INSERT INTO notification(notification_type, date, is_viewed, id_user, id_news, id_comment) VALUES (NewsVote, 2022.10.20, true, 4, 4, NULL);

