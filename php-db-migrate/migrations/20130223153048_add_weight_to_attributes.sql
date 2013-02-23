-- add weight to attributes
-- Migration SQL that makes the change goes here.
alter table category_attribute add column weight int(11); 

-- @UNDO
-- SQL to undo the change goes here.
alter table category_attribute drop column weight;