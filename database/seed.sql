USE mysess_db;

-- insesrt users (7 roles), password for testing is set as password for all users 
-- password is hashed using PHP built in password_hash() function with bcrypt


INSERT INTO users (email, password, first_name, last_name, role, is_active) VALUES
('admin@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fatima', 'Honeino', 'admin', TRUE),
('admin2@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Saja', 'Jaber', 'admin', TRUE),
('teacher@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Israa', 'Honeino', 'teacher', TRUE),
('teacher2@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rahaf', 'Honeino', 'teacher', TRUE),
('therapist@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bouchra', 'Charbel', 'therapist', TRUE),
('therapist2@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Hiba', 'Jaber', 'therapist', TRUE),
('nurse@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Zeinab', 'Jaber', 'nurse', TRUE),
('parent@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Amin', 'HajAli', 'parent', TRUE),
('boarding@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Abbas', 'Badreddine', 'boarding_staff', TRUE),
('security@mysess.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ismail', 'Awada', 'security_guard', TRUE);


-- insert students examples
INSERT INTO students (first_name, last_name, date_of_birth, gender, diagnosis, enrollment_date, guardian_id, is_active) VALUES
('Hussein', 'Hoenino', '2015-03-15', 'male', 'Autism Spectrum Disorder', '2023-09-01', 7, TRUE),
('Ali', 'Badreddine', '2016-07-22', 'female', 'Down Syndrome', '2023-09-01', 8, TRUE),
('Mahmoud', 'Badreddine', '2014-11-10', 'male', 'ADHD', '2023-09-01', 7, TRUE),
('Alaa', 'Mohamad', '2015-05-18', 'female', 'Cerebral Palsy', '2023-09-01', 8, TRUE),
('Amir', 'Abbas', '2016-01-25', 'male', 'Learning Disability', '2024-01-15', 7, TRUE);


-- assign teacher and therapists for students
INSERT INTO student_assignments (student_id, user_id, role_type, start_date) VALUES
-- Teacher assignments
(1, 4, 'teacher', '2026-09-01'), -- means that student Hussein with id 1 auto incremented will be taugth by user teacher 4 Rahaf Honeino
(2, 4, 'teacher', '2026-09-01'), 
(3, 3, 'teacher', '2026-09-01'), 
(4, 3, 'teacher', '2026-09-01'), 
(5, 4, 'teacher', '2024-01-15'), 

-- Therapist assignments
(1, 6, 'therapist', '2023-09-01'), -- same concept as teacher assign
(2, 5, 'therapist', '2026-09-01'), 
(3, 6, 'therapist', '2026-09-01'), 
(4, 5, 'therapist', '2026-09-01'), 
(5, 6, 'therapist', '2024-01-15');


-- insert iep goals 
INSERT INTO iep_goals (student_id, goal_text, target_date, status, category, created_by) VALUES
(1, 'Improve verbal communication skills - use 3-word sentences', '2026-05-01', 'active', 'Communication', 4),
(1, 'Increase social interaction with peers during playtime', '2026-05-01', 'active', 'Social Skills', 4),
(2, 'Develop fine motor skills - hold pencil correctly', '2026-05-01', 'active', 'Motor Skills', 5),
(2, 'Recognize and name 10 colors', '2026-05-01', 'active', 'Cognitive', 5),
(3, 'Improve attention span to 15 minutes for focused tasks', '2026-05-01', 'active', 'Behavioral', 4),
(3, 'Follow 2-step instructions independently', '2026-05-01', 'active', 'Cognitive', 4),
(4, 'Improve gross motor skills - walk with walker independently', '2026-05-01', 'active', 'Motor Skills', 5),
(5, 'Read simple 3-letter words', '2024-05-01', 'active', 'Academic', 4);


-- insert goals progress (examples used for the demo presentation)
INSERT INTO goal_progress (goal_id, score, notes, recorded_by, recorded_at) VALUES
(1, 45, 'Student is making progress, now using 2-word sentences consistently', 4, '2026-05-01 10:00:00'),
(1, 55, 'Improvement noted, occasional 3-word sentences observed', 4, '2026-05-01 10:00:00'),
(1, 65, 'Good progress, using 3-word sentences more frequently', 4, '2026-05-01 10:00:00'),
(2, 40, 'Student shows interest in peers but needs encouragement', 4, '2026-03-01 10:00:00'),
(2, 50, 'Initiated interaction twice this week', 4, '2026-04-01 10:00:00'),
(3, 35, 'Struggles with pencil grip, needs more practice', 5, '2026-03-01 10:00:00'),
(3, 45, 'Slight improvement with adaptive grip tools', 5, '2026-04-01 10:00:00'),
(5, 30, 'Attention span still around 8-10 minutes', 4, '2026-03-01 10:00:00'),
(5, 40, 'Showing improvement, reached 12 minutes today', 4, '2026-04-01 10:00:00');
-- we used a list of iep goals usually used for students in current special education schools 

-- insert session
INSERT INTO sessions (title, type, scheduled_at, duration_minutes, location, status, created_by) VALUES
('Speech therapy for Hussein', 'therapy', '2024-05-06 09:00:00', 45, 'Therapy Room 1', 'scheduled', 4),
('Math class with Group A', 'class', '2026-05-06 10:00:00', 60, 'Classroom 1', 'scheduled', 2),
('Physical therapy for Alaa', 'therapy', '2026-05-06 11:00:00', 45, 'Therapy Room 2', 'scheduled', 5),
('IEP review meeting', 'meeting', '2026-05-07 14:00:00', 60, 'Conference Room', 'scheduled', 4),
('Behavioral therapy', 'therapy', '2026-05-07 09:00:00', 45, 'Therapy Room 1', 'scheduled', 4);


-- insertion of session participants
INSERT INTO session_participants (session_id, user_id, role_in_session, attended) VALUES
(1, 4, 'Therapist', FALSE),
(2, 2, 'Teacher', FALSE),
(3, 5, 'Therapist', FALSE),
(4, 4, 'Therapist', FALSE),
(4, 8, 'Parent', FALSE),
(5, 4, 'Therapist', FALSE);


-- insert session student 
INSERT INTO session_students (session_id, student_id) VALUES
(1, 1), -- Hussein in speech therapy session
(2, 1), 
(2, 2), 
(2, 3), 
(3, 4), 
(4, 2), 
(5, 3); 


-- insert health  records 
INSERT INTO health_records (student_id, record_type, title, description, recorded_by) VALUES
(1, 'allergy', 'Peanut Allergy', 'Severe peanut allergy - EpiPen required', 6),
(2, 'medication', 'Daily Vitamin D', 'Takes vitamin D supplement daily with breakfast', 6),
(3, 'medication', 'ADHD Medication', 'Takes Ritalin 10mg twice daily (morning and noon)', 6),
(4, 'medical_note', 'Physical Therapy Schedule', 'Requires PT 3 times per week for mobility', 6),
(1, 'emergency_contact', 'Emergency Contact', 'Father: Robert Anderson, Phone: 555-0101', 6);


-- insert notf examples also for the demo presentation
INSERT INTO notifications (user_id, type, title, message, is_read) VALUES
(2, 'session_reminder', 'Upcoming Session', 'Math Class - Group A starts in 1 hour', FALSE),
(4, 'session_reminder', 'Upcoming Session', 'Speech Therapy starts in 1 hour', FALSE),
(7, 'progress_update', 'Progress Update', 'New progress logged ', FALSE),
(8, 'session_scheduled', 'Session Scheduled', 'IEP review meeting scheduled for tomorrow at 2:00 PM', FALSE);
