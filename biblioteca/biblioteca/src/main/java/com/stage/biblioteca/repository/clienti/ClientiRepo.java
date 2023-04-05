package com.stage.biblioteca.repository.clienti;

import com.stage.biblioteca.entity.clienti.Clienti;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.Optional;

public interface ClientiRepo extends JpaRepository<Clienti, Integer> {
        Optional<Clienti> findByEmail(String email);
}
