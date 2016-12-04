-- mencari peran nama personnel di sebuah meeting
select a.mr_id, a.mr_name, a.m_id from meeting_role a, personnel_role b where a.mr_id = b.mr_id and b.p_id = 6 and a.m_id = 1;

-- mencari nama-nama personnel di sebuah acara
select a.p_name from personnel a, personnel_role b, meeting_role c, meeting d where d.m_id = c.m_id and a.p_id = b.p_id and b.mr_id = c.mr_id and c.m_id = $id;

-- mencari daftar meeting yang harus dihadiri oleh seseorang
select a.mr_id, a.mr_name, a.m_id, c.m_name, a.pro_quo from meeting_role a, personnel_role b, meeting c
where a.mr_id = b.mr_id and a.m_id = c.m_id and b.p_id = 6;

-- mencari detail waktu sebuah meeting seseorang
select a.row, a.col, a.desc_time, b.m_id, b.m_name from slot a, meeting b, timetable c, personnel d, calendar e
where a.slot_id = c.slot_id and b.m_id = c.m_id and b.m_id = e.m_id and e.p_id = d.p_id and d.p_id = 6;

-- mencari waktu sebuah meeting
select a.row, a.col, b.m_id from slot a, timetable b where a.slot_id = b.slot_id;