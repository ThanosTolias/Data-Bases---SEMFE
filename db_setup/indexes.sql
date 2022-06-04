-- Create Indexes

CREATE INDEX idx_res_fname ON researcher (first_name);
CREATE INDEX idx_res_lname ON researcher (last_name);
CREATE INDEX idx_p_s_date ON project (start_date);
CREATE INDEX idx_p_e_date ON project (end_date);