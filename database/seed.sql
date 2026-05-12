USE mysess_db;

-- INSERT USERS (7 roles)
-- Password for all users: Admin@123
-- Hashed with SHA-256: e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7

INSERT INTO users (email, password, first_name, last_name, role, is_active) VALUES
('admin@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Fatima', 'Honeino', 'admin', TRUE),
('admin2@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Saja', 'Jaber', 'admin', TRUE),
('teacher@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Isaac', 'Newton', 'teacher', TRUE),
('teacher2@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Walter', 'Brattain', 'teacher', TRUE),
('therapist@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Sigmund', 'Freud', 'therapist', TRUE),
('therapist2@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Carl', 'Jung', 'therapist', TRUE),
('nurse@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Jane', 'Austin', 'nurse', TRUE),
('parent@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Gordon', 'Moore', 'parent', TRUE),
('boarding@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Alexander', 'Pushkin', 'boarding_staff', TRUE),
('security@mysess.com', 'e86f78a8a3caf0b60d8e74e5942aa6d86dc150cd3c03338aef25b7d2d7e3acc7', 'Sherlock', 'Holmes', 'security_guard', TRUE);


---- 2. INSERT STUDENTS ----

INSERT INTO students (first_name, last_name, date_of_birth, gender, diagnosis, enrollment_date, guardian_id, is_active) VALUES
('Sami', 'Youssef', '2015-03-15', 'male', 'Autism Spectrum Disorder', '2023-09-01', 7, TRUE),
('Emily', 'Taylor', '2016-07-22', 'female', 'Down Syndrome', '2023-09-01', 8, TRUE),
('John', 'Smith', '2014-11-10', 'male', 'ADHD', '2023-09-01', 7, TRUE),
('Alaa', 'Mohamad', '2015-05-18', 'female', 'Cerebral Palsy', '2023-09-01', 8, TRUE),
('William', 'James', '2016-01-25', 'male', 'Learning Disability', '2024-01-15', 7, TRUE);


---- 3. ASSIGN TEACHERS AND THERAPISTS TO STUDENTS ----

INSERT INTO student_assignments (student_id, user_id, role_type, start_date) VALUES
-- Teacher assignments
(1, 4, 'teacher', '2023-09-01'), -- Sami -> Brattain
(2, 4, 'teacher', '2023-09-01'), -- Emily -> Brattain
(3, 3, 'teacher', '2023-09-01'), -- John -> Newton
(4, 3, 'teacher', '2023-09-01'), -- Alaa -> Newton
(5, 4, 'teacher', '2024-01-15'), -- William -> Brattain

-- Therapist assignments
(1, 6, 'therapist', '2023-09-01'), -- Sami -> Jung
(2, 5, 'therapist', '2023-09-01'), -- Emily -> Freud
(3, 6, 'therapist', '2023-09-01'), -- John -> Jung
(4, 5, 'therapist', '2023-09-01'), -- Alaa -> Freud
(5, 6, 'therapist', '2024-01-15'); -- William -> Jung


---- 4. INSERT IEP GOALS ----

INSERT INTO iep_goals (student_id, goal_text, target_date, status, category, created_by) VALUES
(1, 'Improve verbal communication skills - use 3-word sentences', '2024-06-30', 'active', 'Communication', 4),
(1, 'Increase social interaction with peers during playtime', '2024-06-30', 'active', 'Social Skills', 4),
(2, 'Develop fine motor skills - hold pencil correctly', '2024-06-30', 'active', 'Motor Skills', 5),
(2, 'Recognize and name 10 colors', '2024-06-30', 'active', 'Cognitive', 5),
(3, 'Improve attention span to 15 minutes for focused tasks', '2024-06-30', 'active', 'Behavioral', 4),
(3, 'Follow 2-step instructions independently', '2024-06-30', 'active', 'Cognitive', 4),
(4, 'Improve gross motor skills - walk with walker independently', '2024-06-30', 'active', 'Motor Skills', 5),
(5, 'Read simple 3-letter words', '2024-06-30', 'active', 'Academic', 4);


---- 5. INSERT GOAL PROGRESS (Sample data) ----

INSERT INTO goal_progress (goal_id, score, notes, recorded_by, recorded_at) VALUES
(1, 45, 'Student is making progress, now using 2-word sentences consistently', 4, '2024-03-01 10:00:00'),
(1, 55, 'Improvement noted, occasional 3-word sentences observed', 4, '2024-04-01 10:00:00'),
(1, 65, 'Good progress, using 3-word sentences more frequently', 4, '2024-05-01 10:00:00'),
(2, 40, 'Student shows interest in peers but needs encouragement', 4, '2024-03-01 10:00:00'),
(2, 50, 'Initiated interaction twice this week', 4, '2024-04-01 10:00:00'),
(3, 35, 'Struggles with pencil grip, needs more practice', 5, '2024-03-01 10:00:00'),
(3, 45, 'Slight improvement with adaptive grip tools', 5, '2024-04-01 10:00:00'),
(5, 30, 'Attention span still around 8-10 minutes', 4, '2024-03-01 10:00:00'),
(5, 40, 'Showing improvement, reached 12 minutes today', 4, '2024-04-01 10:00:00');


---- 6. INSERT SESSIONS ----

INSERT INTO sessions (title, type, scheduled_at, duration_minutes, location, status, created_by) VALUES
('Speech Therapy - Sami', 'therapy', '2024-05-06 09:00:00', 45, 'Therapy Room 1', 'scheduled', 4),
('Math Class - Group A', 'class', '2024-05-06 10:00:00', 60, 'Classroom 1', 'scheduled', 2),
('Physical Therapy - Alaa', 'therapy', '2024-05-06 11:00:00', 45, 'Therapy Room 2', 'scheduled', 5),
('IEP Review Meeting - Emily', 'meeting', '2024-05-07 14:00:00', 60, 'Conference Room', 'scheduled', 4),
('Behavioral Therapy - William', 'therapy', '2024-05-07 09:00:00', 45, 'Therapy Room 1', 'scheduled', 4);


---- 7. INSERT SESSION PARTICIPANTS ----

INSERT INTO session_participants (session_id, user_id, role_in_session, attended) VALUES
(1, 4, 'Therapist', FALSE),
(2, 2, 'Teacher', FALSE),
(3, 5, 'Therapist', FALSE),
(4, 4, 'Therapist', FALSE),
(4, 8, 'Parent', FALSE),
(5, 4, 'Therapist', FALSE);


---- 8. INSERT SESSION STUDENTS ----

INSERT INTO session_students (session_id, student_id) VALUES
(1, 1), -- Sami in Speech Therapy
(2, 1), -- Sami in Math Class
(2, 2), -- Emily in Math Class
(2, 3), -- John in Math Class
(3, 4), -- Alaa in Physical Therapy
(4, 2), -- Emily in IEP Review
(5, 3); -- John in Behavioral Therapy


-- 9. INSERT HEALTH RECORDS

INSERT INTO health_records (student_id, record_type, title, description, recorded_by) VALUES
(1, 'allergy', 'Peanut Allergy', 'Severe peanut allergy - EpiPen required', 6),
(2, 'medication', 'Daily Vitamin D', 'Takes vitamin D supplement daily with breakfast', 6),
(3, 'medication', 'ADHD Medication', 'Takes Ritalin 10mg twice daily (morning and noon)', 6),
(4, 'medical_note', 'Physical Therapy Schedule', 'Requires PT 3 times per week for mobility', 6),
(1, 'emergency_contact', 'Emergency Contact', 'Father: Robert Anderson, Phone: 555-0101', 6);


-- 10. INSERT NOTIFICATIONS (Sample)

INSERT INTO notifications (user_id, type, title, message, is_read) VALUES
(2, 'session_reminder', 'Upcoming Session', 'Math Class - Group A starts in 1 hour', FALSE),
(4, 'session_reminder', 'Upcoming Session', 'Speech Therapy - John starts in 1 hour', FALSE),
(7, 'progress_update', 'Progress Update', 'New progress logged for John Anderson', FALSE),
(8, 'session_scheduled', 'Session Scheduled', 'IEP Review Meeting scheduled for tomorrow at 2:00 PM', FALSE);


-- SUCCESS MESSAGE

SELECT '✅ Seed data inserted successfully!' AS Status;
SELECT 'You can now login with:' AS Info;
SELECT 'Email: admin@mysess.com' AS AdminEmail;
SELECT 'Password: Admin@123' AS AdminPassword;
SELECT 'All users have the same password: Admin@123' AS Note;
