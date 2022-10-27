SET search_path TO lbaw2286;

BEGIN TRANSACTION;

SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

-- Insert tag_proposal
INSERT INTO tag_proposal (tag_name, description)
 VALUES ($tag_name, $description);

-- Insert tag_proposal_user
INSERT INTO tag_proposal_user (id_user, id_tag)
 VALUES ($id_user, currval('tag_proposal_id_seq'));

END TRANSACTION;