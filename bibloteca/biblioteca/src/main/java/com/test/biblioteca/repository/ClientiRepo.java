package com.test.biblioteca.repository;
import com.test.biblioteca.entity.Clienti;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.lang.NonNull;
import org.springframework.stereotype.Repository;

import java.util.List;
public interface ClientiRepo extends JpaRepository<Clienti, Long> {

}
