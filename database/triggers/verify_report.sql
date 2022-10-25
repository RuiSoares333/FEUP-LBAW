SET search_path TO lbaw2286;

CREATE FUNCTION verify_report() RETURNS TRIGGER AS $BODY$
BEGIN
      IF NEW.id_user IS NOT NULL AND NEW.id_news IS NOT NULL AND NEW.id_comment IS NOT NULL THEN
         RAISE EXCEPTION 'Invalid report (has all types selected).';
      END IF;
      IF NEW.id_user IS NOT NULL AND NEW.id_news IS NOT NULL THEN
         RAISE EXCEPTION 'Invalid report (has user and comment type).';
      END IF;
      IF NEW.id_user IS NOT NULL AND NEW.id_comment IS NOT NULL THEN
         RAISE EXCEPTION 'Invalid report (has user and news type).';
      END IF;
      IF NEW.id_news IS NOT NULL AND NEW.id_comment IS NOT NULL THEN
         RAISE EXCEPTION 'Invalid report (has news and comment type).';
      END IF;
      IF NEW.id_user IS NULL AND NEW.id_news IS NULL AND NEW.id_comment IS NULL THEN
         RAISE EXCEPTION 'Invalid report (no report selected)';
      END IF;
      RETURN NEW;
END
$BODY$ LANGUAGE plpgsql;


CREATE TRIGGER verify_report
   BEFORE INSERT OR UPDATE ON report 
   EXECUTE PROCEDURE verify_report();
